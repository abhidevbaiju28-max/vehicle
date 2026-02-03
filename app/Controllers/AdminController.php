<?php

namespace App\Controllers;

use App\Models\PermitModel;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('nssapprover/dashboard');
        }
        return view('admin/login');
    }

    public function auth()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, X-CSRF-TOKEN');

        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->verifyCredentials($username, $password);

        if ($admin) {
            $session->set([
                'id' => $admin['id'],
                'username' => $admin['username'],
                'isLoggedIn' => true
            ]);
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid username or password'
        ])->setStatusCode(401);
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('nssapprover');
        }

        $model = new PermitModel();
        
        $search = $this->request->getGet('search');
        $vehicle_no = $this->request->getGet('vehicle_no');
        $status = $this->request->getGet('status');

        if ($search) {
            $model->like('student_name', $search);
        }
        if ($vehicle_no) {
            $model->where('vehicle_number', $vehicle_no);
        }
        if ($status) {
            $model->where('status', $status);
        }

        $data['permits'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        return view('admin/dashboard', $data);
    }

    public function updateStatus()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, X-CSRF-TOKEN');

        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(403);
        }

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $model = new PermitModel();
        if ($model->update($id, ['status' => $status])) {
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error'])->setStatusCode(400);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('nssapprover');
    }
}
