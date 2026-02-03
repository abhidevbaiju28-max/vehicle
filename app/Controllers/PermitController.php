<?php

namespace App\Controllers;

use App\Models\PermitModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use setasign\Fpdi\Fpdi;

class PermitController extends BaseController
{
    public function index()
    {
        return view('permit_form');
    }

    public function submit()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, X-CSRF-TOKEN');

        if ($this->request->getMethod() === 'options') {
            return $this->response->setStatusCode(200);
        }

        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_FORBIDDEN);
        }

        $model = new PermitModel();
        
        // Check for post_max_size violation (which clears $_POST and $_FILES)
        if (empty($_POST) && empty($_FILES) && (int)$this->request->getServer('CONTENT_LENGTH') > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => ['global' => 'The uploaded files exceed the post_max_size directive in php.ini.']
            ])->setStatusCode(400); // 413 Payload Too Large is more accurate but 400 is safer for generic AJAX handlers
        }

        $data = $this->request->getPost();
        
        // Handle File Uploads
        $files = [
            'rc_file'        => $this->request->getFile('rc_file'),
            'license_file'   => $this->request->getFile('license_file'),
            'insurance_file' => $this->request->getFile('insurance_file'),
            'pollution_file' => $this->request->getFile('pollution_file'),
            'consent_file'   => $this->request->getFile('consent_file'),
        ];

        foreach ($files as $dbField => $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                try {
                    $file->move(WRITEPATH . 'uploads/permits', $newName);
                    $data[$dbField] = $newName;
                } catch (\Exception $e) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'errors' => [$dbField => 'File write failed: ' . $e->getMessage() . '. Check server permissions.']
                    ])->setStatusCode(500);
                }
            } else {
                // Capture the specific upload error
                $errorMsg = $file ? $file->getErrorString() . '(' . $file->getError() . ')' : 'File not found';
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => [$dbField => $errorMsg]
                ])->setStatusCode(400); 
            }
        }

        if ($insertedID = $model->insert($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Application submitted successfully!',
                'id'      => $insertedID
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $model->errors()
            ])->setStatusCode(400);
        }
    }

    public function download($id)
    {
        $model = new PermitModel();
        $permit = $model->find($id);

        if (!$permit) {
            return "Application not found.";
        }

        // STEP 1: Generate Page 1 using Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Helvetica');
        
        $dompdf = new Dompdf($options);
        $html = view('permit_pdf', ['permit' => $permit]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $page1_content = $dompdf->output();

        // Save Page 1 temporarily
        $tmp_page1 = WRITEPATH . 'tmp_page1_' . $id . '.pdf';
        file_put_contents($tmp_page1, $page1_content);

        // STEP 2: Use FPDI to combine and overlay
        $pdf = new Fpdi();

        // Add Page 1 (The Permit)
        $pdf->setSourceFile($tmp_page1);
        $tplIdx1 = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($tplIdx1);

        // Add Page 2 (The Vehicle.pdf - Original Copy)
        $sourcePdf = WRITEPATH . 'uploads/Vehicle.pdf'; 
        if (file_exists($sourcePdf)) {
            $pdf->setSourceFile($sourcePdf);
            $tplIdx2 = $pdf->importPage(1); 
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx2);
        }

        // Output the result
        $finalOutput = $pdf->Output('S');

        // Clean up
        @unlink($tmp_page1);

        return $this->response->setHeader('Content-Type', 'application/pdf')
                              ->setHeader('Content-Disposition', 'attachment; filename="Vehicle_Permit_'.$id.'.pdf"')
                              ->setBody($finalOutput);
    }

    public function checkStatus()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, X-CSRF-TOKEN');

        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $vehicle_no = $this->request->getPost('vehicle_number');
        $model = new PermitModel();
        
        $permit = $model->where('vehicle_number', $vehicle_no)
                        ->orderBy('created_at', 'DESC')
                        ->first();

        if ($permit) {
            return $this->response->setJSON([
                'status' => 'success',
                'permit_status' => $permit['status'],
                'student_name' => $permit['student_name']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No record found for this vehicle number.'
        ])->setStatusCode(404);
    }

    public function viewFile($filename)
    {
        $path = WRITEPATH . 'uploads/permits/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $file = new \CodeIgniter\Files\File($path);
        $mimeType = $file->getMimeType();
        
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody(file_get_contents($path));
    }
}
