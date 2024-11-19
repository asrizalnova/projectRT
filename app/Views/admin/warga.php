<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Warga</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="nav-icon fas fa-plus"></i> Tambah Warga
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Nama Warga</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status</th>
                                        <th>Pekerjaan</th>
                                        <th>Keterangan</th>
                                        <th>Status Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($warga_detail as $row): ?>
                                        <tr id="row-<?= $row['nik']; ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['namaKK']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= isset($row['umur']) ? $row['umur'] : '-'; ?></td> <!-- Menampilkan umur -->
                                            <td><?= $row['jenisKelamin']; ?></td>
                                            <td><?= $row['tempatLahir']; ?></td>
                                            <td><?= $row['tanggalLahir']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td><?= $row['pekerjaan']; ?></td>
                                            <td><?= $row['keterangan']; ?></td>
                                            <td><?= $row['statusAktif']; ?></td>
                                            <td class="text-left">
                                                <a data-id="<?= $row['nik']; ?>" class="btn btn-primary btnEditWarga btn-sm">Ubah</a>
                                                <a data-id="<?= $row['nik']; ?>" class="btn btn-danger btnDeleteWarga btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Nama Warga</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status</th>
                                        <th>Pekerjaan</th>
                                        <th>Keterangan</th>
                                        <th>Status Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Warga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createWarga" name="createWarga" action="<?= site_url('warga/store'); ?>" method="post">
                <div class="modal-body">
                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="noKK" class="form-label">Nomor KK</label>
                        <select name="noKK" id="noKK" class="form-select" required>
                            <option value="">Pilih Nomor KK</option>
                            <?php foreach ($kk as $kartuKeluarga): ?>
                                <option value="<?= $kartuKeluarga['noKK'] ?>">
                                    <?= $kartuKeluarga['noKK'] ?> - <?= $kartuKeluarga['namaKK'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisKelamin" class="form-label">jenisKelamin Kas</label>
                        <select name="jenisKelamin" id="jenisKelamin" class="form-select">
                            <option value="Laki-Laki" <?= old('jenisKelamin') == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="Perempuan" <?= old('jenisKelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" required>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Warga -->
<div class="modal fade" id="editModalWarga" tabindex="-1" aria-labelledby="editModalWargaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="editModalWargaLabel">Edit Data Warga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <form id="editWargaForm" method="POST">
                    <!-- NIK -->
                    <div class="mb-3">
                        <label for="editNik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="editNik" name="nik" required>
                    </div>

                    <!-- Nomor KK -->
                    <div class="mb-3">
                        <label for="editNoKK" class="form-label">Nomor KK</label>
                        <select class="form-select" id="editNoKK" name="noKK" required>
                            <option value="">Pilih Nomor KK</option>
                        </select>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="editJenisKelamin" name="jenisKelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="mb-3">
                        <label for="editTempatLahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="editTempatLahir" name="tempatLahir" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="editTanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="editTanggalLahir" name="tanggalLahir" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                        </select>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="mb-3">
                        <label for="editPekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="editPekerjaan" name="pekerjaan" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="editKeterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="editKeterangan" name="keterangan" rows="3"></textarea>
                    </div>

                    <!-- Status Aktif -->
                    <div class="mb-3">
                        <label for="editStatusAktif" class="form-label">Status Aktif</label>
                        <select class="form-select" id="editStatusAktif" name="statusAktif" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Pindah">Pindah</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editWargaForm">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection(); ?>