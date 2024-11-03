<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper d-flex justify-content-center mt-5"> <!-- Menghapus align-items-center -->
    <div class="col-12 col-md-6 col-lg-4 mt-5"> <!-- Lebar form diperkecil -->
        <h2 class="text-center mb-4 text-primary">Edit Kartu Keluarga</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('kk/update/' . $kk['noKK']) ?>" method="post" class="shadow p-4 rounded bg-light">
            <div class="mb-3">
                <label for="noKK" class="form-label">Nomor Kartu Keluarga</label>
                <input type="text" class="form-control" id="noKK" name="noKK" value="<?= $kk['noKK']; ?> " disabled>
            </div>
            <div class="mb-3">
                <label for="namaKK" class="form-label">Nama Kepala Keluarga</label>
                <input type="text" class="form-control" id="namaKK" name="namaKK" value="<?= old('namaKK', $kk['namaKK']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="menetap" <?= old('status', $kk['status']) == 'menetap' ? 'selected' : '' ?>>Menetap</option>
                    <option value="pindah" <?= old('status', $kk['status']) == 'pindah' ? 'selected' : '' ?>>Pindah</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('kk') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>