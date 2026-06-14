<?= $this->extend('App\Module\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <a href="/pasien/create" class="btn btn-primary" id="btn-tambah-pasien">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Pasien
    </a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <!-- Stats -->
    <div class="stat-cards">
        <div class="stat-card">
            <div class="stat-card-label">Total Pasien</div>
            <div class="stat-card-value gradient"><?= count($pasien) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Laki-laki</div>
            <div class="stat-card-value" style="color: var(--info);">
                <?= count(array_filter($pasien, fn($p) => $p['jenis_kelamin'] === 'Laki-laki')) ?>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Perempuan</div>
            <div class="stat-card-value" style="color: #f472b6;">
                <?= count(array_filter($pasien, fn($p) => $p['jenis_kelamin'] === 'Perempuan')) ?>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h2>Data Pasien</h2>
            <span style="font-size: 0.8rem; color: var(--text-muted);"><?= count($pasien) ?> data</span>
        </div>

        <?php if (empty($pasien)) : ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <h3>Belum ada data pasien</h3>
                <p>Mulai tambahkan data pasien untuk mengelola rekam medis klinik Anda.</p>
                <a href="/pasien/create" class="btn btn-primary" id="btn-tambah-pasien-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Pasien Pertama
                </a>
            </div>
        <?php else : ?>
            <div class="table-wrapper">
                <table id="table-pasien">
                    <thead>
                        <tr>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pasien as $p) : ?>
                            <tr>
                                <td>
                                    <span style="font-family: monospace; font-size: 0.82rem; color: var(--accent-primary);"><?= esc($p['no_rm']) ?></span>
                                </td>
                                <td class="td-name"><?= esc($p['nama']) ?></td>
                                <td>
                                    <span class="badge <?= $p['jenis_kelamin'] === 'Laki-laki' ? 'badge-male' : 'badge-female' ?>">
                                        <?= esc($p['jenis_kelamin']) ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y', strtotime($p['tanggal_lahir'])) ?></td>
                                <td><?= esc($p['no_telepon'] ?: '—') ?></td>
                                <td>
                                    <div class="td-actions">
                                        <a href="/pasien/<?= $p['id'] ?>" class="btn btn-secondary btn-sm btn-icon" title="Lihat Detail" id="btn-lihat-<?= $p['id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="/pasien/<?= $p['id'] ?>/edit" class="btn btn-secondary btn-sm btn-icon" title="Edit" id="btn-edit-<?= $p['id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        <button class="btn btn-danger btn-sm btn-icon" title="Hapus" onclick="confirmDelete(<?= $p['id'] ?>, '<?= esc($p['nama']) ?>')" id="btn-hapus-<?= $p['id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Delete Confirmation Dialog -->
    <div class="confirm-overlay" id="confirm-overlay">
        <div class="confirm-dialog">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="var(--danger)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" style="margin-bottom: 12px;"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            <h3>Hapus Data Pasien?</h3>
            <p>Data <strong id="delete-name"></strong> akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
            <div class="confirm-actions">
                <button class="btn btn-secondary" onclick="closeConfirm()" id="btn-batal-hapus">Batal</button>
                <form id="delete-form" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-danger" id="btn-konfirmasi-hapus">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function confirmDelete(id, name) {
        document.getElementById('delete-name').textContent = name;
        document.getElementById('delete-form').action = '/pasien/' + id + '/delete';
        document.getElementById('confirm-overlay').classList.add('show');
    }

    function closeConfirm() {
        document.getElementById('confirm-overlay').classList.remove('show');
    }

    // Close on overlay click
    document.getElementById('confirm-overlay').addEventListener('click', function(e) {
        if (e.target === this) closeConfirm();
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeConfirm();
    });
</script>
<?= $this->endSection() ?>
