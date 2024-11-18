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
                    <h1>Data Kartu Keluarga</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="nav-icon fas fa-plus"></i> Tambah KK
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
                                        <th>No KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($kk_detail as $row): ?>
                                        <tr id="<?php echo $row['noKK']; ?>"> <!-- Tambahkan ID untuk baris tabel -->
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['noKK']; ?></td>
                                            <td><?= $row['namaKK']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td class="text-left">
                                                <a data-id="<?= $row['noKK']; ?>" class="btn btn-primary btnEditKK btn-sm">Edit</a>
                                                <a data-id="<?= $row['noKK']; ?>" class="btn btn-danger btnDeleteKK btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>No KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Status</th>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah KK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createKK" name="createKK" action="<?= site_url('kk/store'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="noKK" class="form-label">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="noKK" name="noKK" placeholder="Masukkan nomor KK" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaKK" class="form-label">Nama Kepala Keluarga</label>
                        <input type="text" class="form-control" id="namaKK" name="namaKK" placeholder="Masukkan nama kepala keluarga" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Menetap">Menetap</option>
                            <option value="Pindah">Pindah</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit KK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKKForm" name="editKKForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNoKK" class="form-label">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="editNoKK" name="noKK" placeholder="Masukkan nomor KK" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaKK" class="form-label">Nama Kepala Keluarga</label>
                        <input type="text" class="form-control" id="editNamaKK" name="namaKK" placeholder="Masukkan nama kepala keluarga" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select name="status" id="editStatus" class="form-select">
                            <option value="Menetap">Menetap</option>
                            <option value="Pindah">Pindah</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>