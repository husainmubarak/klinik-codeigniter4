<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('header_actions') ?>
    <a href="<?= base_url() ?>pasien/create" class="btn btn-primary" id="btn-tambah-pasien">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Pasien
    </a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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
        document.getElementById('delete-form').action = '<?= base_url() ?>pasien/' + id + '/delete';
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
