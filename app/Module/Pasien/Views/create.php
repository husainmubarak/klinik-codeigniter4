<?= $this->extend('App\Module\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <a href="/pasien" class="btn btn-secondary" id="btn-kembali">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali
    </a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <?php if ($validation) : ?>
        <div class="alert alert-danger" id="alert-validation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            Terdapat kesalahan pada formulir. Silakan periksa kembali.
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2>Formulir Pasien Baru</h2>
        </div>
        <div class="card-body">
            <form action="/pasien/store" method="post" id="form-tambah-pasien">
                <div class="form-row">
                    <div class="form-group">
                        <label for="no_rm" class="form-label">Nomor Rekam Medis *</label>
                        <input type="text" name="no_rm" id="no_rm" class="form-control"
                               placeholder="Contoh: RM-0001"
                               value="<?= old('no_rm') ?>" required>
                        <?php if (isset($validation['no_rm'])) : ?>
                            <div class="form-error"><?= $validation['no_rm'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                               placeholder="Masukkan nama lengkap pasien"
                               value="<?= old('nama') ?>" required>
                        <?php if (isset($validation['nama'])) : ?>
                            <div class="form-error"><?= $validation['nama'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">— Pilih Jenis Kelamin —</option>
                            <option value="Laki-laki" <?= old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <?php if (isset($validation['jenis_kelamin'])) : ?>
                            <div class="form-error"><?= $validation['jenis_kelamin'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                               value="<?= old('tanggal_lahir') ?>" required>
                        <?php if (isset($validation['tanggal_lahir'])) : ?>
                            <div class="form-error"><?= $validation['tanggal_lahir'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input type="tel" name="no_telepon" id="no_telepon" class="form-control"
                           placeholder="Contoh: 08123456789"
                           value="<?= old('no_telepon') ?>">
                    <?php if (isset($validation['no_telepon'])) : ?>
                        <div class="form-error"><?= $validation['no_telepon'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat Lengkap *</label>
                    <textarea name="alamat" id="alamat" class="form-control"
                              placeholder="Masukkan alamat lengkap pasien"
                              required><?= old('alamat') ?></textarea>
                    <?php if (isset($validation['alamat'])) : ?>
                        <div class="form-error"><?= $validation['alamat'] ?></div>
                    <?php endif; ?>
                </div>

                <div style="display: flex; gap: 12px; padding-top: 8px;">
                    <button type="submit" class="btn btn-primary" id="btn-simpan">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Simpan Data
                    </button>
                    <a href="/pasien" class="btn btn-secondary" id="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>
