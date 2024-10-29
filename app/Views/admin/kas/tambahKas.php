<?= $this->extend('Template/Template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
    <div class="container-xl d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="app-card app-card-orders-table shadow-sm mb-5 bg-white rounded p-4">
                <h2 class="text-center mb-4 text-primary">Tambah Kas</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('kas/store') ?>" method="post">
                    <div class="mb-3">
                        <label for="namaKas" class="form-label">Nama Kas</label>
                        <input type="text" class="form-control" id="namaKas" name="namaKas" placeholder="Masukkan nama kas" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Kas</label>
                        <select name="jenis" id="jenis" class="form-select">
                            <option value="Bulanan" <?= old('jenis') == 'Bulanan' ? 'selected' : '' ?>>Bulanan</option>
                            <option value="Mingguan" <?= old('jenis') == 'Mingguan' ? 'selected' : '' ?>>Mingguan</option>
                            <option value="Insidental" <?= old('jenis') == 'Insidental' ? 'selected' : '' ?>>Insidental</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saldo" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Masukkan saldo awal" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('/kas') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
