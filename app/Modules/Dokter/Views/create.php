<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Tambah Dokter</h2>

    <div class="card">
        <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
            
            <form action="<?= base_url() ?>dokter" method="post">
                <div class="mb-3">
                    <label for="nama_dokter" class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_dokter') ? 'is-invalid' : '' ?>" id="nama_dokter" name="nama_dokter" value="<?= old('nama_dokter') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_dokter') ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="spesialisasi" class="form-label">Spesialisasi</label>
                    <input type="text" class="form-control <?= $validation->hasError('spesialisasi') ? 'is-invalid' : '' ?>" id="spesialisasi" name="spesialisasi" value="<?= old('spesialisasi') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('spesialisasi') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="poli_id" class="form-label">Poli</label>
                    <select class="form-control <?= $validation->hasError('poli_id') ? 'is-invalid' : '' ?>" id="poli_id" name="poli_id">
                        <option value="">Pilih Poli</option>
                        <?php foreach($polis as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= old('poli_id') == $p['id'] ? 'selected' : '' ?>><?= $p['nama_poli'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('poli_id') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control <?= $validation->hasError('no_telepon') ? 'is-invalid' : '' ?>" id="no_telepon" name="no_telepon" value="<?= old('no_telepon') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_telepon') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url() ?>dokter" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
