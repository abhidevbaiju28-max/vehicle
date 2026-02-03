# Vehicle Permit Registration System - Project Report

## 1. Project Overview
This is a **Vehicle Permit Registration System** built with **CodeIgniter 4 (PHP)**. It allows students to apply for vehicle permits by submitting personal details and uploading mandatory documents (RC, License, Insurance, Pollution, Consent). Administrators can review applications and manage approvals.

### Key Features
-   **Student Portal:** Form submission with file uploads, status check, and permit PDF download.
-   **Admin Portal:** Dashboard for reviewing applications, filtering by status, and approval/rejection.
-   **PDF Generation:** Merges generated permit details with a static vehicle template using `DomPDF` and `FPDI`.
-   **Security:** CSRF protection, secure file handling, and input validation.

---

## 2. Technical Architecture
-   **Framework:** CodeIgniter 4
-   **Language:** PHP 8.2+
-   **Database:** MySQL
-   **Frontend:** PHP Views tailored with TailwindCSS
-   **Dependencies:** `dompdf/dompdf`, `setasign/fpdi-fpdf`

### Directory Structure
-   `app/Controllers`: Logic for Permit (`PermitController`) and Admin (`AdminController`).
-   `app/Models`: Database interactions (`PermitModel`, `AdminModel`).
-   `app/Views`: User Interface (`permit_form.php`, `admin/dashboard.php`).
-   `writable/uploads`: Secure storage for uploaded documents.

---

## 3. Deployment Guide (cPanel)

Follow these steps to deploy to `https://vehicle.nsscrky.ac.in/vehicle_register/`.

### Step 1: Prepare Files
1.  Zip the project folder (exclude `.git`, `tests`, `writable/cache`).
2.  Export the local database to `.sql`.

### Step 2: Upload to cPanel
1.  Go to **File Manager** -> `public_html`.
2.  Create folder `vehicle_register`.
3.  Upload and extract the zip file.

### Step 3: Database Setup
1.  Go to **MySQL Database Wizard**.
2.  Create Database and User. Note the credentials.
3.  Go to **phpMyAdmin** and import the `.sql` file.

### Step 4: Configure Environment
1.  Rename `env_production` to `.env`.
2.  Edit `.env` with new database credentials:
    ```ini
    database.default.database = your_db_name
    database.default.username = your_db_user
    database.default.password = your_db_pass
    ```

### Step 5: Permissions & PHP
1.  Set `writable` folder permissions to **755**.
2.  Ensure PHP version is **8.2+** with `intl` and `fileinfo` enabled.

### Troubleshooting
-   **Validation Failed:** Increase `upload_max_filesize` to **16M** and `post_max_size` to **20M** in cPanel PHP Selector options.
-   **File Write Failed:** Check permissions for `writable/uploads` (755 or 775).
