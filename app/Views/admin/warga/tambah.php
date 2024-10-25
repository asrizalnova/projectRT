<?= $this->extend('Template/Template'); ?>
<?= $this->section('content'); ?>


<body>
    <div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
        <div class="container-xl d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-6 col-lg-5">
                <div class="app-card app-card-orders-table shadow-sm mb-5 bg-white rounded p-4">
                    <h2 class="text-center mb-4 text-primary">Tambah Data Warga</h2>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('warga/proses_tambah') ?>" method="post">
                        <!-- <?= csrf_field() ?> -->

                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>

                        <div class="mb-3">
                            <label for="noKk" class="form-label">No KK</label>
                            <select class="form-select" id="noKk" name="noKk" required>
                                <option value="">Pilih No KK</option>
                                <?php foreach ($all_kk as $kk): ?>
                                    <option value="<?= $kk['noKK'] ?>">
                                        <?= $kk['noKK'] ?> - <?= $kk['namaKK'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" maxlength="45" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" maxlength="36" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" maxlength="72" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="statusAktif" class="form-label">Status Aktif</label>
                            <select class="form-select" id="statusAktif" name="statusAktif" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Pindah">Pindah</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Tambah Warga</button>
                        <a href="<?= base_url('warga/index') ?>" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?= $this->endSection('content'); ?>