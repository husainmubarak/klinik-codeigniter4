<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Tambah Poli</h2>

    <div class="card">
        <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
            
            <form action="<?= base_url() ?>poli" method="post">
                <div class="mb-3">
                    <label for="nama_poli" class="form-label">Nama Poli</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_poli') ? 'is-invalid' : '' ?>" id="nama_poli" name="nama_poli" value="<?= old('nama_poli') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_poli') ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : '' ?>" id="keterangan" name="keterangan"><?= old('keterangan') ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('keterangan') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url() ?>poli" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
