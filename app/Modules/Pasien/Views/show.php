<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Detail Pasien</h2>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary"><?= esc($pasien['nama_pasien']) ?></h5>
            <span class="badge <?= $pasien['jenis_kelamin'] === 'L' ? 'bg-info' : 'bg-danger' ?>">
                <?= $pasien['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nomor Rekam Medis</div>
                <div class="col-md-9"><?= esc($pasien['no_rm']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nama Lengkap</div>
                <div class="col-md-9"><?= esc($pasien['nama_pasien']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Jenis Kelamin</div>
                <div class="col-md-9"><?= $pasien['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Tanggal Lahir</div>
                <div class="col-md-9">
                    <?= date('d F Y', strtotime($pasien['tanggal_lahir'])) ?>
                    <small class="text-muted ms-2">
                        (<?php
                            $birthDate = new DateTime($pasien['tanggal_lahir']);
                            $now = new DateTime();
                            $age = $now->diff($birthDate);
                            echo $age->y . ' tahun';
                        ?>)
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">No. Telepon</div>
                <div class="col-md-9"><?= esc($pasien['no_telepon'] ?: '—') ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Terdaftar Sejak</div>
                <div class="col-md-9">
                    <?= $pasien['created_at'] ? date('d F Y, H:i', strtotime($pasien['created_at'])) : '—' ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Alamat Lengkap</div>
                <div class="col-md-9"><?= nl2br(esc($pasien['alamat'])) ?></div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <a href="<?= base_url() ?>pasien/<?= $pasien['id'] ?>/edit" class="btn btn-warning">Edit</a>
                <a href="<?= base_url() ?>pasien" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
