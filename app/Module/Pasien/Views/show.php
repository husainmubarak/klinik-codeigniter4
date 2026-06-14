<?= $this->extend('App\Module\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <div style="display: flex; gap: 8px;">
        <a href="/pasien/<?= $pasien['id'] ?>/edit" class="btn btn-primary btn-sm" id="btn-edit-detail">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Edit
        </a>
        <a href="/pasien" class="btn btn-secondary btn-sm" id="btn-kembali">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali
        </a>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="card">
        <div class="card-header">
            <div>
                <h2 style="margin-bottom: 4px;"><?= esc($pasien['nama']) ?></h2>
                <span style="font-size: 0.8rem; color: var(--text-muted);">Detail informasi pasien</span>
            </div>
            <span class="badge <?= $pasien['jenis_kelamin'] === 'Laki-laki' ? 'badge-male' : 'badge-female' ?>">
                <?= esc($pasien['jenis_kelamin']) ?>
            </span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Nomor Rekam Medis</div>
                    <div class="detail-value" style="font-family: monospace; color: var(--accent-primary);">
                        <?= esc($pasien['no_rm']) ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nama Lengkap</div>
                    <div class="detail-value"><?= esc($pasien['nama']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Jenis Kelamin</div>
                    <div class="detail-value"><?= esc($pasien['jenis_kelamin']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Lahir</div>
                    <div class="detail-value">
                        <?= date('d F Y', strtotime($pasien['tanggal_lahir'])) ?>
                        <span style="color: var(--text-muted); font-size: 0.8rem; margin-left: 4px;">
                            (<?php
                                $birthDate = new DateTime($pasien['tanggal_lahir']);
                                $now = new DateTime();
                                $age = $now->diff($birthDate);
                                echo $age->y . ' tahun';
                            ?>)
                        </span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">No. Telepon</div>
                    <div class="detail-value"><?= esc($pasien['no_telepon'] ?: '—') ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Terdaftar Sejak</div>
                    <div class="detail-value">
                        <?= $pasien['created_at'] ? date('d F Y, H:i', strtotime($pasien['created_at'])) : '—' ?>
                    </div>
                </div>
            </div>

            <!-- Alamat full width -->
            <div style="padding-top: 16px; margin-top: 0;">
                <div class="detail-label">Alamat Lengkap</div>
                <div class="detail-value" style="margin-top: 6px; line-height: 1.7;">
                    <?= nl2br(esc($pasien['alamat'])) ?>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
