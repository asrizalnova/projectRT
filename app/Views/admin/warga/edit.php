<?= $this->extend('Template/Template'); ?>

<?= $this->section('content'); ?>

<body>
    <div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
        <div class="container-xl d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-6 col-lg-5">
                <div class="app-card app-card-orders-table shadow-sm mb-5 bg-white rounded p-4">
                    <h2 class="text-center mb-4 text-primary">Edit Data Warga</h2>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('warga/proses_edit/' . $wargaData->nik); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik', $wargaData->nik); ?>" readonly>
                        </div>

                        <div class="mb-3">
    <label for="noKk" class="form-label">No KK</label>
    <select class="form-select" id="noKk" name="noKk" required>
        <option value="">Pilih No KK</option>
        <?php foreach ($kkData as $kk): ?>
            <option value="<?= $kk['noKK']; ?>" 
                <?= old('noKk', $wargaData->noKk) == $kk['noKK'] ? 'selected' : ''; ?>>
                <?= $kk['noKK'] . ' - ' . $kk['namaKK']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $wargaData->nama); ?>" maxlength="45" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                                <option value="Laki-Laki" <?= old('jenisKelamin', $wargaData->jenisKelamin) === 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= old('jenisKelamin', $wargaData->jenisKelamin) === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="<?= old('tempatLahir', $wargaData->tempatLahir); ?>" maxlength="36" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="<?= old('tanggalLahir', $wargaData->tanggalLahir); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Kepala Keluarga" <?= old('status', $wargaData->status) === 'Kepala Keluarga' ? 'selected' : ''; ?>>Kepala Keluarga</option>
                                <option value="Istri" <?= old('status', $wargaData->status) === 'Istri' ? 'selected' : ''; ?>>Istri</option>
                                <option value="Anak" <?= old('status', $wargaData->status) === 'Anak' ? 'selected' : ''; ?>>Anak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $wargaData->pekerjaan); ?>" maxlength="72" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan', $wargaData->keterangan); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="statusAktif" class="form-label">Status Aktif</label>
                            <select class="form-select" id="statusAktif" name="statusAktif" required>
                                <option value="Aktif" <?= old('statusAktif', $wargaData->statusAktif) === 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Pindah" <?= old('statusAktif', $wargaData->statusAktif) === 'Pindah' ? 'selected' : ''; ?>>Pindah</option>
                                <option value="Meninggal" <?= old('statusAktif', $wargaData->statusAktif) === 'Meninggal' ? 'selected' : ''; ?>>Meninggal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Data</button>
                        <a href="<?= base_url('/warga'); ?>" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?= $this->endSection(); ?>
