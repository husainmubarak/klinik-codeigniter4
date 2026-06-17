<?= $this->extend('App\Modules\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <div class="btn-group" role="group">
        <a href="<?= base_url('/pasien/' . $pasien['id'] . '/edit') ?>" class="btn btn-warning btn-sm" id="btn-edit-detail">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <a href="<?= base_url('/pasien') ?>" class="btn btn-secondary btn-sm" id="btn-kembali">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div>
                <h6 class="m-0 font-weight-bold text-primary"><?= esc($pasien['nama_pasien']) ?></h6>
                <small class="text-gray-500">Detail informasi pasien</small>
            </div>
            <?php if ($pasien['jenis_kelamin'] === 'Laki-laki') : ?>
                <span class="badge badge-info px-2 py-1"><i class="fas fa-mars mr-1"></i> Laki-laki</span>
            <?php else : ?>
                <span class="badge badge-warning px-2 py-1"><i class="fas fa-venus mr-1"></i> Perempuan</span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Nomor Rekam Medis</span>
                    <span class="h5 font-weight-bold text-gray-800 font-monospace"><?= esc($pasien['no_rm']) ?></span>
                </div>
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Nama Lengkap</span>
                    <span class="h5 font-weight-bold text-gray-800"><?= esc($pasien['nama_pasien']) ?></span>
                </div>
            </div>
            <hr class="my-2">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Jenis Kelamin</span>
                    <span class="h6 font-weight-bold text-gray-800"><?= esc($pasien['jenis_kelamin']) ?></span>
                </div>
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Tanggal Lahir</span>
                    <span class="h6 font-weight-bold text-gray-800">
                        <?= date('d F Y', strtotime($pasien['tanggal_lahir'])) ?>
                        <span class="text-gray-500 text-xs ml-1">
                            (<?php
                                $birthDate = new DateTime($pasien['tanggal_lahir']);
                                $now = new DateTime();
                                $age = $now->diff($birthDate);
                                echo $age->y . ' tahun';
                            ?>)
                        </span>
                    </span>
                </div>
            </div>
            <hr class="my-2">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">No. Telepon</span>
                    <span class="h6 font-weight-bold text-gray-800"><?= esc($pasien['no_telepon'] ?: '—') ?></span>
                </div>
                <div class="col-md-6 mb-3">
                    <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Terdaftar Sejak</span>
                    <span class="h6 font-weight-bold text-gray-800">
                        <?= $pasien['created_at'] ? date('d F Y, H:i', strtotime($pasien['created_at'])) : '—' ?>
                    </span>
                </div>
            </div>
            <hr class="my-2">
            <div class="mb-3">
                <span class="text-xs font-weight-bold text-primary text-uppercase d-block">Alamat Lengkap</span>
                <span class="h6 text-gray-800"><?= nl2br(esc($pasien['alamat'])) ?></span>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
