<?= $this->extend('App\Modules\Pasien\Views\layout') ?>

<?= $this->section('header_actions') ?>
    <a href="<?= base_url('/pasien') ?>" class="btn btn-secondary btn-sm shadow-sm" id="btn-kembali">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
    </a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <?php if ($validation) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-validation">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Terdapat kesalahan pada formulir. Silakan periksa kembali.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pasien Baru</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/pasien/store') ?>" method="post" id="form-tambah-pasien">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="no_rm" class="text-gray-800 font-weight-bold">Nomor Rekam Medis *</label>
                        <input type="text" name="no_rm" id="no_rm" class="form-control <?= isset($validation['no_rm']) ? 'is-invalid' : '' ?>"
                               placeholder="Contoh: RM-0001"
                               value="<?= old('no_rm') ?>" required>
                        <?php if (isset($validation['no_rm'])) : ?>
                            <div class="invalid-feedback"><?= $validation['no_rm'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nama" class="text-gray-800 font-weight-bold">Nama Lengkap *</label>
                        <input type="text" name="nama" id="nama" class="form-control <?= isset($validation['nama']) ? 'is-invalid' : '' ?>"
                               placeholder="Masukkan nama lengkap pasien"
                               value="<?= old('nama') ?>" required>
                        <?php if (isset($validation['nama'])) : ?>
                            <div class="invalid-feedback"><?= $validation['nama'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="jenis_kelamin" class="text-gray-800 font-weight-bold">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= isset($validation['jenis_kelamin']) ? 'is-invalid' : '' ?>" required>
                            <option value="">— Pilih Jenis Kelamin —</option>
                            <option value="Laki-laki" <?= old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <?php if (isset($validation['jenis_kelamin'])) : ?>
                            <div class="invalid-feedback"><?= $validation['jenis_kelamin'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="tanggal_lahir" class="text-gray-800 font-weight-bold">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control <?= isset($validation['tanggal_lahir']) ? 'is-invalid' : '' ?>"
                               value="<?= old('tanggal_lahir') ?>" required>
                        <?php if (isset($validation['tanggal_lahir'])) : ?>
                            <div class="invalid-feedback"><?= $validation['tanggal_lahir'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="text-gray-800 font-weight-bold">No. Telepon</label>
                    <input type="tel" name="no_telepon" id="no_telepon" class="form-control <?= isset($validation['no_telepon']) ? 'is-invalid' : '' ?>"
                           placeholder="Contoh: 08123456789"
                           value="<?= old('no_telepon') ?>">
                    <?php if (isset($validation['no_telepon'])) : ?>
                        <div class="invalid-feedback"><?= $validation['no_telepon'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="alamat" class="text-gray-800 font-weight-bold">Alamat Lengkap *</label>
                    <textarea name="alamat" id="alamat" class="form-control <?= isset($validation['alamat']) ? 'is-invalid' : '' ?>"
                              placeholder="Masukkan alamat lengkap pasien"
                              rows="3" required><?= old('alamat') ?></textarea>
                    <?php if (isset($validation['alamat'])) : ?>
                        <div class="invalid-feedback"><?= $validation['alamat'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" id="btn-simpan">
                        <i class="fas fa-save mr-1"></i> Simpan Data
                    </button>
                    <a href="<?= base_url('/pasien') ?>" class="btn btn-secondary" id="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Set active sidebar navigation dynamically
    document.addEventListener('DOMContentLoaded', function() {
        const navPasien = document.getElementById('nav-pasien');
        const navDashboard = document.getElementById('nav-dashboard');
        
        if (navDashboard) navDashboard.classList.remove('active');
        if (navPasien) navPasien.classList.add('active');
    });
</script>
<?= $this->endSection() ?>
