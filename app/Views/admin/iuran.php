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
                    <h1>Data Iuran</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="nav-icon fas fa-plus"></i> Tambah Iuran
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
                                        <th>Nama Kas</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Nama User</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($iuran_detail as $row): ?>
                                        <tr id="<?php echo $row['idIuran']; ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['namaKas']; ?></td>
                                            <td><?= $row['namaKK']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['bulan']; ?></td>
                                            <td><?= $row['tahun']; ?></td>
                                            <td><?= $row['jumlah']; ?></td>
                                            <td><?= $row['tanggal']; ?></td>
                                            <td class="text-left">
                                                <a data-id="<?= $row['idIuran']; ?>" class="btn btn-primary btnEditIuran btn-sm">Edit</a>
                                                <a data-id="<?= $row['idIuran']; ?>" class="btn btn-danger btnDeleteIuran btn-sm">Delete</a>
                                            </td>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kas</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Nama User</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
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

    <!-- Modal -->
    <<!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Iuran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="createIuran" name="createIuran" action="<?= site_url('iuran/store'); ?>" method="post">
                        <div class="modal-body">
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                            <div class="mb-3">
                                <label for="idKas" class="form-label">Kas</label>
                                <select name="idKas" id="idKas" class="form-select" required>
                                    <option value="">Pilih Kas</option>
                                    <?php foreach ($kas as $k): ?>
                                        <option value="<?= $k['idKas'] ?>">
                                            <?= $k['idKas'] ?> - <?= $k['namaKas'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select" required>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" required min="1900" max="<?= date('Y') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModalIuran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Iuran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editIuranForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editIdUser" class="form-label">User</label>
                        <select name="idUser" id="editIdUser" class="form-select" required>
                            <!-- Dropdown options for users will be populated here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editIdKas" class="form-label">Kas</label>
                        <select name="idKas" id="editIdKas" class="form-select" required>
                            <!-- Dropdown options for kas will be populated here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editNoKK" class="form-label">No KK</label>
                        <select name="noKK" id="editNoKK" class="form-select" required>
                            <!-- Dropdown options for no KK will be populated here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editBulan" class="form-label">Bulan</label>
                        <input type="text" class="form-control" id="editBulan" name="bulan" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="editTahun" name="tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="editJumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" name="tanggal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>