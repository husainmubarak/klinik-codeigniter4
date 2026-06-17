<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Manajemen Pasien</h2>
        <a href="<?= base_url() ?>pasien/new" class="btn btn-primary" id="btn-tambah-pasien">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="margin-right: 4px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Pasien
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-title text-uppercase mb-1">Total Pasien</h6>
                    <h2 class="display-5 fw-bold mb-0"><?= count($pasien) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title text-uppercase mb-1">Laki-laki</h6>
                    <h2 class="display-5 fw-bold mb-0"><?= count(array_filter($pasien, fn($p) => $p['jenis_kelamin'] === 'L')) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6 class="card-title text-uppercase mb-1">Perempuan</h6>
                    <h2 class="display-5 fw-bold mb-0"><?= count(array_filter($pasien, fn($p) => $p['jenis_kelamin'] === 'P')) ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Data Pasien</h5>
        </div>
        <div class="card-body">

        <?php if (empty($pasien)) : ?>
            <div class="text-center py-5">
                <h3>Belum ada data pasien</h3>
                <p>Mulai tambahkan data pasien untuk mengelola rekam medis klinik Anda.</p>
                <a href="<?= base_url() ?>pasien/new" class="btn btn-primary">
                    Tambah Pasien Pertama
                </a>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-pasien">
                    <thead>
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>L/P</th>
                            <th>Tanggal Lahir</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pasien as $p) : ?>
                            <tr>
                                <td><?= esc($p['no_rm']) ?></td>
                                <td><?= esc($p['nama_pasien']) ?></td>
                                <td><?= $p['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                <td><?= date('d-m-Y', strtotime($p['tanggal_lahir'])) ?></td>
                                <td><?= esc($p['no_telepon'] ?: '—') ?></td>
                                <td>
                                    <a href="<?= base_url() ?>pasien/<?= $p['id'] ?>" class="btn btn-sm btn-info">Detail</a>
                                    <a href="<?= base_url() ?>pasien/<?= $p['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?= base_url() ?>pasien/<?= $p['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data pasien <?= esc($p['nama_pasien']) ?>?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

<?= $this->endSection() ?>
