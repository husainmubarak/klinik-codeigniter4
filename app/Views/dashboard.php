<?= $this->extend('App\Modules\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <span class="badge badge-success py-2 px-3">
        <i class="fas fa-check-circle mr-1"></i> Sistem Berjalan Normal
    </span>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Welcome Card -->
    <div class="card shadow mb-4">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="text-primary font-weight-bold">Selamat Datang di KlinikPro</h1>
                    <p class="lead text-gray-800">Kelola data pasien, rekam medis, antrean, dan administrasi klinik dalam satu dasbor terintegrasi yang modern dan cepat.</p>
                </div>
                <div class="col-lg-4 text-right">
                    <a href="<?= base_url('/pasien/create') ?>" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-plus mr-1"></i> Pasien Baru
                    </a>
                    <a href="<?= base_url('/pasien') ?>" class="btn btn-secondary btn-lg shadow-sm ml-2">
                        <i class="fas fa-search mr-1"></i> Cari Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pasien</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= esc($stats['total']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kunjungan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Antrean Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kapasitas Kamar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">85%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Patients -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pasien Baru Terdaftar</h6>
                    <a href="<?= base_url('/pasien') ?>" class="btn btn-sm btn-link text-primary font-weight-bold p-0">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($recentPatients)) : ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-slash fa-3x text-gray-300 mb-3"></i>
                            <h6 class="text-gray-800 font-weight-bold">Belum ada pasien</h6>
                            <p class="text-gray-500 mb-0">Daftar pasien baru untuk mengisi riwayat klinik.</p>
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. RM</th>
                                        <th>Nama</th>
                                        <th>L/P</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentPatients as $p) : ?>
                                        <tr>
                                            <td>
                                                <code class="text-primary font-weight-bold"><?= esc($p['no_rm']) ?></code>
                                            </td>
                                            <td class="font-weight-bold text-gray-800"><?= esc($p['nama']) ?></td>
                                            <td>
                                                <?php if ($p['jenis_kelamin'] === 'Laki-laki') : ?>
                                                    <span class="badge badge-info">L</span>
                                                <?php else : ?>
                                                    <span class="badge badge-warning">P</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d M H:i', strtotime($p['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Access & Info -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Cepat Modul</h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('/pasien') ?>" class="btn btn-outline-primary btn-block text-left p-3 mb-3">
                        <i class="fas fa-user-injured mr-2"></i> Kelola Data Pasien
                    </a>
                    <button class="btn btn-outline-secondary btn-block text-left p-3" disabled>
                        <i class="fas fa-file-medical mr-2"></i> E-Rekam Medis (SOAP)
                    </button>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body font-weight-bold text-gray-800">
                    <div class="d-flex justify-content-between mb-2">
                        <span>PHP Version</span>
                        <code><?= PHP_VERSION ?></code>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Framework</span>
                        <span>CodeIgniter 4.7.3</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Environment</span>
                        <span class="text-success"><?= esc(ENVIRONMENT) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navPasien = document.getElementById('nav-pasien');
        const navDashboard = document.getElementById('nav-dashboard');
        
        if (navPasien) navPasien.classList.remove('active');
        if (navDashboard) navDashboard.classList.add('active');
    });
</script>
<?= $this->endSection() ?>
