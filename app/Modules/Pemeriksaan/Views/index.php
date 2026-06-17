<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Data Pemeriksaan</h2>
        <a href="<?= base_url() ?>pemeriksaan/new" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="margin-right: 4px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Pemeriksaan
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No RM - Pasien</th>
                            <th>Poli (Dokter)</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($pemeriksaans as $p): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date('d-m-Y', strtotime($p['tanggal_periksa'])) ?></td>
                            <td><?= esc($p['no_rm']) ?> - <?= esc($p['nama_pasien']) ?></td>
                            <td><?= esc($p['nama_poli']) ?> (<?= esc($p['nama_dokter']) ?>)</td>
                            <td><?= esc($p['diagnosa']) ?></td>
                            <td><?= esc($p['tindakan']) ?></td>
                            <td class="text-nowrap">
                                <a href="<?= base_url() ?>pemeriksaan/<?= $p['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?= base_url() ?>pemeriksaan/<?= $p['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data pemeriksaan ini? (Status pendaftaran akan dikembalikan ke menunggu)');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($pemeriksaans)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada riwayat pemeriksaan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
