<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Data Pendaftaran</h2>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="/pendaftaran/new" class="btn btn-primary mb-3">Tambah Pendaftaran</a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Daftar</th>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($pendaftarans as $p): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date('d-m-Y', strtotime($p['tanggal_daftar'])) ?></td>
                            <td><?= esc($p['nama'] ?? '') ?></td>
                            <td><?= esc($p['nama_poli']) ?></td>
                            <td><?= esc($p['nama_dokter']) ?></td>
                            <td><?= esc($p['keluhan']) ?></td>
                            <td>
                                <?php if($p['status'] == 'menunggu'): ?>
                                    <span class="badge bg-warning">Menunggu</span>
                                <?php elseif($p['status'] == 'selesai'): ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Batal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/pendaftaran/<?= $p['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/pendaftaran/<?= $p['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
