<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Data Poli</h2>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url() ?>poli/new" class="btn btn-primary mb-3">Tambah Poli</a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($polis as $p): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($p['nama_poli']) ?></td>
                            <td><?= esc($p['keterangan']) ?></td>
                            <td>
                                <a href="<?= base_url() ?>poli/<?= $p['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?= base_url() ?>poli/<?= $p['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?');">
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
