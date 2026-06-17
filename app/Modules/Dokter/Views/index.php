<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Data Dokter</h2>
    
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php endif; ?>

    <a href="<?= base_url() ?>dokter/new" class="btn btn-primary mb-3">Tambah Dokter</a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Spesialisasi</th>
                            <th>Poli</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($dokters as $d): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($d['nama_dokter']) ?></td>
                            <td><?= esc($d['spesialisasi']) ?></td>
                            <td><?= esc($d['nama_poli']) ?></td>
                            <td><?= esc($d['no_telepon']) ?></td>
                            <td><?= esc($d['email']) ?></td>
                            <td>
                                <a href="<?= base_url() ?>dokter/<?= $d['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?= base_url() ?>dokter/<?= $d['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?');">
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
