<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Edit Pasien</h2>

    <div class="card">
        <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
            
            <form action="<?= base_url() ?>pasien/<?= $pasien['id'] ?>" method="post">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3">
                    <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                    <input type="text" class="form-control <?= $validation->hasError('no_rm') ? 'is-invalid' : '' ?>" id="no_rm" name="no_rm" value="<?= old('no_rm', $pasien['no_rm']) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_rm') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_pasien') ? 'is-invalid' : '' ?>" id="nama_pasien" name="nama_pasien" value="<?= old('nama_pasien', $pasien['nama_pasien']) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pasien') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?= old('jenis_kelamin', $pasien['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= old('jenis_kelamin', $pasien['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_kelamin') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control <?= $validation->hasError('tanggal_lahir') ? 'is-invalid' : '' ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir', $pasien['tanggal_lahir']) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_lahir') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control <?= $validation->hasError('no_telepon') ? 'is-invalid' : '' ?>" id="no_telepon" name="no_telepon" value="<?= old('no_telepon', $pasien['no_telepon']) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_telepon') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="3"><?= old('alamat', $pasien['alamat']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url() ?>pasien" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
