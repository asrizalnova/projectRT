<?= $this->extend('Template/Template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
    <div class="container-xl d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="app-card app-card-orders-table shadow-sm mb-5 bg-white rounded p-4">
                <h2 class="text-center mb-4 text-primary">Edit Kartu Keluarga</h2>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('kk/update/' . $kk['noKK']) ?>" method="post">
                    <div class="mb-3">
                        <label for="noKK" class="form-label">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="noKK" name="noKK" value="<?= $kk['noKK']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="namaKK" class="form-label">Nama Kepala Keluarga</label>
                        <input type="text" class="form-control" id="namaKK" name="namaKK" value="<?= old('namaKK', $kk['namaKK']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="menetap" <?= old('status', $kk['status']) == 'menetap' ? 'selected' : '' ?>>Menetap</option>
                            <option value="pindah" <?= old('status', $kk['status']) == 'pindah' ? 'selected' : '' ?>>Pindah</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
