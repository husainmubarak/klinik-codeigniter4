<?= $this->extend('App\Module\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <span style="font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px;">
        <span style="width: 8px; height: 8px; background-color: var(--success); border-radius: 50%; display: inline-block; box-shadow: 0 0 8px var(--success);"></span>
        Sistem Berjalan Normal
    </span>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Welcome Card -->
    <div class="card" style="margin-bottom: 24px; background: linear-gradient(135deg, rgba(108, 99, 255, 0.15) 0%, rgba(168, 85, 247, 0.05) 100%); border-color: rgba(108, 99, 255, 0.2);">
        <div class="card-body" style="padding: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 6px; background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Selamat Datang di KlinikPro
                </h1>
                <p style="color: var(--text-secondary); max-width: 550px; font-size: 0.9rem;">
                    Kelola data pasien, rekam medis, antrean, dan administrasi klinik dalam satu dasbor terintegrasi yang modern dan cepat.
                </p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="/pasien/create" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Pasien Baru
                </a>
                <a href="/pasien" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    Cari Data
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="stat-cards">
        <div class="stat-card">
            <div class="stat-card-label">Total Pasien</div>
            <div class="stat-card-value gradient"><?= esc($stats['total']) ?></div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Terdaftar di database</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Kunjungan Hari Ini</div>
            <div class="stat-card-value" style="color: var(--info);">12</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Pasien rawat jalan</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Antrean Aktif</div>
            <div class="stat-card-value" style="color: var(--warning);">3</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Sedang menunggu dokter</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Kapasitas Kamar</div>
            <div class="stat-card-value" style="color: var(--success);">85%</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Tersedia 3 dari 20 bed</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; margin-top: 24px;" id="dashboard-grid">
        <!-- Recent Patients -->
        <div class="card">
            <div class="card-header">
                <h2>Pasien Baru Terdaftar</h2>
                <a href="/pasien" style="font-size: 0.8rem; color: var(--accent-primary); text-decoration: none; font-weight: 600;">Lihat Semua</a>
            </div>
            <div class="card-body" style="padding: 0;">
                <?php if (empty($recentPatients)) : ?>
                    <div class="empty-state" style="padding: 40px 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width: 48px; height: 48px;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                        <h3>Belum ada pasien</h3>
                        <p>Daftar pasien baru untuk mengisi riwayat klinik.</p>
                    </div>
                <?php else : ?>
                    <div class="table-wrapper">
                        <table>
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
                                            <span style="font-family: monospace; font-size: 0.82rem; color: var(--accent-primary); font-weight: 600;"><?= esc($p['no_rm']) ?></span>
                                        </td>
                                        <td class="td-name"><?= esc($p['nama']) ?></td>
                                        <td>
                                            <span class="badge <?= $p['jenis_kelamin'] === 'Laki-laki' ? 'badge-male' : 'badge-female' ?>" style="padding: 2px 8px; font-size: 0.68rem;">
                                                <?= $p['jenis_kelamin'] === 'Laki-laki' ? 'L' : 'P' ?>
                                            </span>
                                        </td>
                                        <td style="font-size: 0.8rem; color: var(--text-muted);">
                                            <?= date('d M H:i', strtotime($p['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Access & Info -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Service Shortcuts -->
            <div class="card">
                <div class="card-header">
                    <h2>Akses Cepat Modul</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="/pasien" class="sidebar-link" style="background: var(--bg-input); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 14px; margin: 0; display: flex; align-items: center;">
                        <span style="background: rgba(108, 99, 255, 0.15); color: var(--accent-primary); padding: 10px; border-radius: var(--radius-sm); margin-right: 14px; display: inline-flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                        </span>
                        <div>
                            <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem;">Kelola Data Pasien</div>
                            <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 2px;">Lihat, tambah, edit, dan hapus rekam pasien.</div>
                        </div>
                    </a>
                    
                    <div class="sidebar-link" style="opacity: 0.6; cursor: not-allowed; background: var(--bg-input); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 14px; margin: 0; display: flex; align-items: center;">
                        <span style="background: rgba(96, 165, 250, 0.15); color: var(--info); padding: 10px; border-radius: var(--radius-sm); margin-right: 14px; display: inline-flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        </span>
                        <div>
                            <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem;">E-Rekam Medis (SOAP)</div>
                            <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 2px;">Catat riwayat pemeriksaan kesehatan pasien.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Developer Info / Meta -->
            <div class="card">
                <div class="card-body" style="padding: 20px; font-size: 0.8rem; color: var(--text-secondary);">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>PHP Version</span>
                        <span style="font-family: monospace; color: var(--text-primary);"><?= PHP_VERSION ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>Framework</span>
                        <span style="color: var(--text-primary);">CodeIgniter 4.7.3</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Environment</span>
                        <span style="color: var(--success); font-weight: 600;"><?= esc(ENVIRONMENT) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Set active sidebar navigation dynamically
    document.addEventListener('DOMContentLoaded', function() {
        const navPasien = document.getElementById('nav-pasien');
        const navDashboard = document.getElementById('nav-dashboard');
        
        if (navPasien) navPasien.classList.remove('active');
        if (navDashboard) navDashboard.classList.add('active');
    });
</script>

<style>
    /* Responsive adjustment for dashboard grid */
    @media (max-width: 992px) {
        #dashboard-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>
