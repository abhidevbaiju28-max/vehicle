<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 25px; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #111827; line-height: 1.6; font-size: 11px; margin: 0; padding: 0; }
        
        .border-container { border: 3px double #1e3a8a; padding: 30px; border-radius: 4px; position: relative; background: #fff; overflow: hidden; }
        .watermark { position: absolute; top: 40%; left: 0; font-size: 90px; color: rgba(30, 58, 138, 0.04); transform: rotate(-45deg); z-index: -1; font-weight: bold; width: 100%; text-align: center; }
        
        .header { text-align: center; margin-bottom: 30px; border-bottom: 1px solid #1e3a8a; padding-bottom: 20px; }
        .college-mini { font-size: 10px; color: #64748b; text-transform: uppercase; font-weight: 700; letter-spacing: 2px; margin-bottom: 8px; }
        .college-name { font-size: 32px; font-weight: 800; color: #1e3a8a; margin-bottom: 0px; text-transform: uppercase; line-height: 1; }
        .sub-header { font-size: 14px; font-weight: 600; color: #3b82f6; margin-top: 5px; text-transform: uppercase; }
        
        .permit-title { font-size: 18px; font-weight: bold; color: #ffffff; background: #1e3a8a; padding: 10px; border-radius: 2px; display: block; margin-top: 20px; text-transform: uppercase; letter-spacing: 3px; }
        

        .section { margin-top: 35px; }
        .section-title { font-size: 13px; font-weight: 800; color: #1e3a8a; border-left: 5px solid #1e3a8a; padding-left: 10px; margin-bottom: 15px; text-transform: uppercase; background: #f1f5f9; padding-top: 5px; padding-bottom: 5px; }
        
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 12px 8px; vertical-align: top; border-bottom: 1px solid #e5e7eb; }
        .label { font-weight: 700; color: #4b5563; width: 35%; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        .value { color: #000; font-size: 12px; font-weight: 600; }
        
        .vehicle-highlight { font-size: 18px; color: #1e3a8a; letter-spacing: 2px; font-weight: 900; display: inline-block; padding: 5px 15px; border: 2px solid #1e3a8a; background: #f0f9ff; }

        .footer { clear: both; margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 15px; font-size: 9px; color: #94a3b8; font-weight: 500; text-align: center; }
        .qr-placeholder { float: right; margin-top: -50px; width: 60px; height: 60px; border: 1px solid #e2e8f0; border-radius: 4px; display: block; text-align: center; font-size: 8px; color: #cbd5e1; padding-top: 20px; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="border-container">
        <div class="watermark">NSS COLLEGE RAJAKUMARI</div>
        
        <div class="header">
            <div class="college-mini">Official Document</div>
            <div class="college-name">NSS COLLEGE RAJAKUMARI</div>
             <div class="permit-title">Vehicle Entry Permit</div>
        </div>


        <div class="section">
            <div class="section-title">Academic & Personal Details</div>
            <table class="info-table">
                <tr>
                    <td class="label">Full Name of Student</td>
                    <td class="value"><?= strtoupper($permit['student_name']) ?></td>
                </tr>
                <tr>
                    <td class="label">Course & Year</td>
                    <td class="value"><?= strtoupper($permit['course_year']) ?></td>
                </tr>
                <tr>
                    <td class="label">Class / Division</td>
                    <td class="value"><?= strtoupper($permit['class_number']) ?></td>
                </tr>
                <tr>
                    <td class="label">Residential Address</td>
                    <td class="value"><?= $permit['student_address'] ?></td>
                </tr>
                <tr>
                    <td class="label">Primary Contact (Student)</td>
                    <td class="value"><?= $permit['student_contact'] ?></td>
                </tr>
                <tr>
                    <td class="label">Parent Contact</td>
                    <td class="value"><?= $permit['parent_contact'] ?></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Vehicle & Regulatory Information</div>
            <table class="info-table">
                <tr>
                    <td class="label">Registration Number</td>
                    <td class="value">
                        <div class="vehicle-highlight"><?= strtoupper($permit['vehicle_number']) ?></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Registered Owner (RC)</td>
                    <td class="value"><?= strtoupper($permit['rc_owner_name']) ?></td>
                </tr>
                <tr>
                    <td class="label">Driving License No.</td>
                    <td class="value"><?= strtoupper($permit['license_number']) ?></td>
                </tr>
                <tr>
                    <td class="label">Permit Issue Date</td>
                    <td class="value"><?= date('d F Y', strtotime($permit['created_at'])) ?></td>
                </tr>
                <tr>
                    <td class="label">Validity Period</td>
                    <td class="value">Current Academic Session</td>
                </tr>
            </table>
        </div>

        <div class="section" style="margin-top: 50px;">
            <div style="padding: 20px; border: 1px dashed #1e3a8a; background: #f8fafc;">
                <p style="margin: 0; color: #1e3a8a; font-weight: 600; font-size: 11px; line-height: 1.8;">
                    This document certifies that <strong><?= strtoupper($permit['student_name']) ?></strong> is authorized to enter the campus with the specified vehicle. 
                    The permit holder is bound by and has agreed to the terms and conditions outlined in the appended campus vehicle policy.
                </p>
            </div>
        </div>

        <div class="qr-placeholder">
            VERIFIED<br>DOCUMENT
        </div>

        <div class="footer">
            Generated by NSS Campus Management System | <?= date('Y') ?> | Official Issuance
        </div>
    </div>
</body>
</html>
