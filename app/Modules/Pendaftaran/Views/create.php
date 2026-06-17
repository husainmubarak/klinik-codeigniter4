<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Tambah Pendaftaran</h2>

    <div class="card">
        <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
            
            <form action="/pendaftaran" method="post">
                <div class="mb-3">
                    <label for="pasien_id" class="form-label">Pasien</label>
                    <select class="form-control <?= $validation->hasError('pasien_id') ? 'is-invalid' : '' ?>" id="pasien_id" name="pasien_id">
                        <option value="">Pilih Pasien</option>
                        <?php foreach($pasiens as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= old('pasien_id') == $p['id'] ? 'selected' : '' ?>><?= $p['nama_pasien'] ?? $p['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('pasien_id') ?>
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
                    <label for="dokter_id" class="form-label">Dokter</label>
                    <select class="form-control <?= $validation->hasError('dokter_id') ? 'is-invalid' : '' ?>" id="dokter_id" name="dokter_id">
                        <option value="">Pilih Dokter</option>
                        <?php foreach($dokters as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= old('dokter_id') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_dokter'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('dokter_id') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                    <input type="date" class="form-control <?= $validation->hasError('tanggal_daftar') ? 'is-invalid' : '' ?>" id="tanggal_daftar" name="tanggal_daftar" value="<?= old('tanggal_daftar', date('Y-m-d')) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_daftar') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea class="form-control <?= $validation->hasError('keluhan') ? 'is-invalid' : '' ?>" id="keluhan" name="keluhan" rows="3"><?= old('keluhan') ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('keluhan') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/pendaftaran" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
