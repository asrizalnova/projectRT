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
                    <h1>Data Pengeluaran</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="nav-icon fas fa-plus"></i> Tambah Pengeluaran
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
                                        <th>Nama Pengeluaran</th>
                                        <th>Nama Kas</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Admin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pengeluaran_detail as $row): ?>
                                        <tr id="<?php echo $row['idPengeluaran']; ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['namaPengeluaran']; ?></td>
                                            <td><?= $row['namaKas']; ?></td>
                                            <td><?= $row['int']; ?></td>
                                            <td><?= $row['tanggal']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td class="text-left">
                                                <a data-id="<?= $row['idPengeluaran']; ?>" class="btn btn-primary btnEditPengeluaran btn-sm">Edit</a>
                                                <a data-id="<?= $row['idPengeluaran']; ?>" class="btn btn-danger btnDeletePengeluaran btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Nama Kas</th>
                                        <th>Nama Pengeluaran</th>
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
</div>

<!-- Modal Create-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="example ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createPengeluaran" name="createPengeluaran" action="<?= site_url('pengeluaran/store'); ?>" method="post">
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
                        <label for="namaPengeluaran" class="form-label">Nama Pengeluaran</label>
                        <input type="text" class="form-control" id="namaPengeluaran" name="namaPengeluaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="int" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="int" name="int" required min="1">
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

<!-- Edit Modal -->
<div class="modal fade" id="editModalPengeluaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPengeluaranForm" action="" method="post">
                <input type="hidden" id="editIdPengeluaran" name="idPengeluaran">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editIdKas" class="form-label">Kas</label>
                        <select name="idKas" id="editIdKas" class="form-select" required>
                            <!-- Dropdown options for kas will be populated here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaPengeluaran" class="form-label">Nama Pengeluaran</label>
                        <input type="text" class="form-control" id="editNamaPengeluaran" name="namaPengeluaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="editInt" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="editInt" name="int" required>
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

<script>

</script>

<?= $this->endSection(); ?>