<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Klinik Sederhana') ?></title>
    <!-- Google Fonts: Inter for a clean, medical-friendly modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2563eb; /* Soft clinic blue */
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc; /* Very light slate gray/white */
            --bg-sidebar: #ffffff;
            --text-main: #334155;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            padding-top: 1.5rem;
        }

        .sidebar-brand {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 1rem;
        }

        .sidebar hr {
            color: var(--border-color);
            margin: 1.5rem 0;
            opacity: 1;
        }

        .sidebar-nav {
            padding: 0 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-nav a {
            color: var(--text-muted);
            text-decoration: none;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-nav a i {
            font-size: 1.1rem;
        }

        .sidebar-nav a:hover {
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        .sidebar-nav a.active {
            background-color: #eff6ff; /* Light blue bg */
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            font-weight: 600;
            padding: 1rem 1rem 0.5rem 1rem;
        }

        /* Main Content */
        .main-wrapper {
            background-color: var(--bg-body);
        }

        /* Navbar */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
        }

        .user-badge {
            background-color: #f1f5f9;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 0.4rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .user-role {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-left: 6px;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .role-admin { background-color: #fee2e2; color: #b91c1c; }
        .role-user { background-color: #e0f2fe; color: #1d4ed8; }

        .btn-logout {
            color: var(--text-muted);
            border-color: var(--border-color);
            border-radius: 0.5rem;
            font-weight: 500;
        }
        
        .btn-logout:hover {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* Cards & Containers */
        .content-area {
            padding: 2rem;
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05);
            background-color: #ffffff;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
            border-top-left-radius: var(--radius-md) !important;
            border-top-right-radius: var(--radius-md) !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        h2 {
            font-weight: 600;
            color: #0f172a;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Buttons */
        .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 0.4rem;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgb(37 99 235 / 0.2);
        }

        .btn-warning {
            background-color: #fef08a;
            border-color: #fef08a;
            color: #854d0e;
        }

        .btn-warning:hover {
            background-color: #fde047;
            border-color: #fde047;
            color: #713f12;
        }

        .btn-danger {
            background-color: #fee2e2;
            border-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-danger:hover {
            background-color: #fca5a5;
            border-color: #fca5a5;
            color: #991b1b;
        }

        .btn-info {
            background-color: #e0f2fe;
            border-color: #e0f2fe;
            color: #0369a1;
        }

        .btn-info:hover {
            background-color: #bae6fd;
            border-color: #bae6fd;
            color: #0c4a6e;
        }
        
        .btn-secondary {
            background-color: #f1f5f9;
            border-color: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
            border-color: #e2e8f0;
            color: #334155;
        }

        /* Tables */
        .table {
            color: var(--text-main);
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            border-bottom: 2px solid var(--border-color);
            padding: 1rem;
            background-color: #f8fafc;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
        }

        /* Forms */
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgb(56 189 248 / 0.1);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" style="width: 260px; flex-shrink: 0;">
            <div class="sidebar-brand">
                <i class="bi bi-hospital" style="font-size: 1.5rem;"></i>
                KlinikKu
            </div>
            <hr>
            
            <div class="sidebar-nav">
                <div class="nav-section-title">Layanan</div>
                <a href="<?= base_url() ?>pendaftaran" class="<?= uri_string() == 'pendaftaran' ? 'active' : '' ?>">
                    <i class="bi bi-calendar2-check"></i> Pendaftaran
                </a>
                <a href="<?= base_url() ?>pemeriksaan" class="<?= uri_string() == 'pemeriksaan' ? 'active' : '' ?>">
                    <i class="bi bi-clipboard2-pulse"></i> Pemeriksaan
                </a>
                
                <div class="nav-section-title mt-2">Data Induk</div>
                <a href="<?= base_url() ?>pasien" class="<?= uri_string() == 'pasien' ? 'active' : '' ?>">
                    <i class="bi bi-people"></i> Data Pasien
                </a>
                
                <?php if(session()->get('role') == 'admin'): ?>
                    <a href="<?= base_url() ?>dokter" class="<?= uri_string() == 'dokter' ? 'active' : '' ?>">
                        <i class="bi bi-person-badge"></i> Data Dokter
                    </a>
                    <a href="<?= base_url() ?>poli" class="<?= uri_string() == 'poli' ? 'active' : '' ?>">
                        <i class="bi bi-diagram-3"></i> Data Poli
                    </a>
                    
                    <div class="nav-section-title mt-2">Sistem</div>
                    <a href="<?= base_url() ?>laporan" class="<?= uri_string() == 'laporan' ? 'active' : '' ?>">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 main-wrapper d-flex flex-column min-vh-100">
            <!-- Navbar -->
            <nav class="navbar navbar-custom">
                <div class="container-fluid px-0">
                    <button class="btn btn-outline-secondary d-lg-none me-2 border-0" type="button" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="user-badge d-flex align-items-center">
                            <i class="bi bi-person-circle me-2 text-muted"></i>
                            <?= session()->get('username') ?>
                            <span class="user-role <?= session()->get('role') == 'admin' ? 'role-admin' : 'role-user' ?>">
                                <?= session()->get('role') ?>
                            </span>
                        </div>
                        <a href="<?= base_url() ?>logout" class="btn btn-logout btn-sm px-3">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content-area flex-grow-1">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
