<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Klinik Sederhana') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4>KlinikKu</h4>
            <hr>
            <a href="<?= base_url() ?>pendaftaran" class="<?= uri_string() == 'pendaftaran' ? 'active' : '' ?>"><i class="bi bi-calendar-check"></i> Pendaftaran</a>
            <a href="<?= base_url() ?>pasien" class="<?= uri_string() == 'pasien' ? 'active' : '' ?>"><i class="bi bi-person"></i> Pasien</a>
            <a href="<?= base_url() ?>pemeriksaan" class="<?= uri_string() == 'pemeriksaan' ? 'active' : '' ?>"><i class="bi bi-clipboard2-pulse"></i> Pemeriksaan</a>
            
            <?php if(session()->get('role') == 'admin'): ?>
                <a href="<?= base_url() ?>dokter" class="<?= uri_string() == 'dokter' ? 'active' : '' ?>"><i class="bi bi-heart-pulse"></i> Dokter</a>
                <a href="<?= base_url() ?>poli" class="<?= uri_string() == 'poli' ? 'active' : '' ?>"><i class="bi bi-building"></i> Poli</a>
                <a href="<?= base_url() ?>laporan" class="<?= uri_string() == 'laporan' ? 'active' : '' ?>"><i class="bi bi-file-earmark-text"></i> Laporan</a>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 bg-light">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary d-lg-none me-2" type="button" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3">
                            Halo, <strong><?= session()->get('username') ?></strong> 
                            <span class="badge bg-<?= session()->get('role') == 'admin' ? 'danger' : 'primary' ?>"><?= ucfirst(session()->get('role')) ?></span>
                        </span>
                        <a href="<?= base_url() ?>logout" class="btn btn-sm btn-outline-danger">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="p-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
