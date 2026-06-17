# Clinic Management System - Developer & AI Documentation

This document provides an overview of the Clinic Management System implementation, designed to help developers and AI assistants understand the project structure, architecture, and current state.

## 🏗️ Architecture (HMVC)

The project uses a custom **HMVC (Hierarchical Model View Controller)** structure built on top of CodeIgniter 4.

All domain logic is encapsulated inside `app/Modules/`. The `app/Config/Autoload.php` has been updated to map the `App\Modules` namespace to this directory.

### Module Structure
```text
app/Modules/
├── Auth/           # Login, Authentication, and Session management
├── Dokter/         # CRUD for Doctors (Admin only)
├── Laporan/        # Reporting & PDF Export (Admin only)
├── Pasien/         # CRUD for Patients (Admin & User)
├── Pendaftaran/    # Registration/Appointments (Admin & User)
└── Poli/           # CRUD for Clinics/Departments (Admin only)
```
Inside each module, you will find `Controllers/`, `Models/`, and `Views/`.

## 🗄️ Database Schema & Models

The application relies on 5 main tables. **Note: No migrations are provided per requirements**, but the tables must be created manually or via external SQL.

1. `users` (id, username, email, password, role, created_at, updated_at)
2. `poli` (id, nama_poli, keterangan, created_at, updated_at)
3. `dokter` (id, nama_dokter, spesialisasi, no_telepon, email, poli_id, created_at, updated_at)
4. `pasien` (id, no_rm, nama_pasien, tanggal_lahir, jenis_kelamin, alamat, no_telepon, created_at, updated_at)
5. `pendaftaran` (id, pasien_id, dokter_id, poli_id, tanggal_daftar, keluhan, status, created_at, updated_at)

### Seeder
To generate the default admin account, run:
```bash
php spark db:seed DatabaseSeeder
```
**Default Credentials:**
- Email/Username: `admin@klinik.local` (or `admin`)
- Password: `admin123`
- Role: `admin`

## 🔒 Authentication & Routing

Routes are centrally defined in `app/Config/Routes.php`.

Two custom filters control access (defined in `app/Config/Filters.php`):
1. **`auth`** (`App\Filters\AuthFilter`): Checks if `session()->get('isLoggedIn')` is true. Redirects to `/login` if not.
2. **`admin`** (`App\Filters\AdminFilter`): Checks if `session()->get('role') === 'admin'`. Returns a 403 Forbidden view if not.

## 🎨 Views & Layout

- **Master Template:** `app/Views/layouts/main.php` (Includes Bootstrap 5, Sidebar, Navbar).
- **Module Views:** Extend the master template using `<?= $this->extend('App\Views\layouts\main') ?>`.
- **Validation Errors:** Displayed inline using Bootstrap's `is-invalid` class.
- **Flash Messages:** Rendered as Bootstrap alerts in the views.

## 🤖 Notes for AI Assistants

If you are an AI reading this to help the user extend the application, keep the following in mind:
- **Routing:** Do not create routes in module-specific files. All routes are grouped in `app/Config/Routes.php`.
- **Validation:** CodeIgniter 4's built-in validation is used directly within the Controllers (e.g., `$this->validate($rules)`).
- **Relationships:** Foreign key joins (like joining `dokter` with `poli`) are handled using CI4's Query Builder in the Models (e.g., `DokterModel::getDokterWithPoli()`).
- **PDF Export:** The `LaporanController` uses `dompdf/dompdf` to generate PDF reports. The view for the PDF is located at `app/Modules/Laporan/Views/pdf.php`.
- **Styling:** Stick to Bootstrap 5 utility classes. Avoid writing custom CSS unless absolutely necessary.