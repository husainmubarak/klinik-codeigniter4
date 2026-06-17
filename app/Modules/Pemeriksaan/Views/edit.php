<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2>Edit Pemeriksaan</h2>

    <div class="card">
        <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
            
            <form action="<?= base_url() ?>pemeriksaan/<?= $pemeriksaan['id'] ?>" method="post">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3">
                    <label for="pendaftaran_id" class="form-label">Data Antrean / Pendaftaran</label>
                    <select class="form-control <?= $validation->hasError('pendaftaran_id') ? 'is-invalid' : '' ?>" id="pendaftaran_id" name="pendaftaran_id">
                        <option value="">Pilih Pasien</option>
                        <?php foreach($pendaftarans as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= old('pendaftaran_id', $pemeriksaan['pendaftaran_id']) == $p['id'] ? 'selected' : '' ?>>
                                <?= esc($p['no_rm']) ?> - <?= esc($p['nama_pasien']) ?> (Poli: <?= esc($p['nama_poli']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('pendaftaran_id') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_periksa" class="form-label">Tanggal Pemeriksaan</label>
                    <input type="date" class="form-control <?= $validation->hasError('tanggal_periksa') ? 'is-invalid' : '' ?>" id="tanggal_periksa" name="tanggal_periksa" value="<?= old('tanggal_periksa', $pemeriksaan['tanggal_periksa']) ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_periksa') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa Penyakit</label>
                    <textarea class="form-control <?= $validation->hasError('diagnosa') ? 'is-invalid' : '' ?>" id="diagnosa" name="diagnosa" rows="3"><?= old('diagnosa', $pemeriksaan['diagnosa']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('diagnosa') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tindakan" class="form-label">Tindakan Medis</label>
                    <textarea class="form-control <?= $validation->hasError('tindakan') ? 'is-invalid' : '' ?>" id="tindakan" name="tindakan" rows="3"><?= old('tindakan', $pemeriksaan['tindakan']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tindakan') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="resep_obat" class="form-label">Resep Obat (Opsional)</label>
                    <textarea class="form-control <?= $validation->hasError('resep_obat') ? 'is-invalid' : '' ?>" id="resep_obat" name="resep_obat" rows="3"><?= old('resep_obat', $pemeriksaan['resep_obat']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('resep_obat') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                    <textarea class="form-control <?= $validation->hasError('catatan') ? 'is-invalid' : '' ?>" id="catatan" name="catatan" rows="2"><?= old('catatan', $pemeriksaan['catatan']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('catatan') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Data</button>
                <a href="<?= base_url() ?>pemeriksaan" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
