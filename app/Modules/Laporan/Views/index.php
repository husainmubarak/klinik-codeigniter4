<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Laporan Pendaftaran</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form action="/laporan" method="get" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" class="form-control" value="<?= esc($tgl_awal) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="<?= esc($tgl_akhir) ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="/laporan/export-pdf?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pendaftarans)): ?>
                            <tr><td colspan="6" class="text-center">Tidak ada data pendaftaran.</td></tr>
                        <?php else: ?>
                            <?php $i = 1; foreach($pendaftarans as $p): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d-m-Y', strtotime($p['tanggal_daftar'])) ?></td>
                                <td><?= esc($p['nama'] ?? '') ?></td>
                                <td><?= esc($p['nama_poli']) ?></td>
                                <td><?= esc($p['nama_dokter']) ?></td>
                                <td><?= ucfirst($p['status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
