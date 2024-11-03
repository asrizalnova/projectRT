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
                    <h1>Data Kas</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="nav-icon fas fa-plus"></i> Tambah Kas
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
                                        <th>Jenis</th>
                                        <th>Saldo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($kas_detail as $row): ?>
                                        <tr id="<?php echo $row['idKas']; ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['namaKas']; ?></td>
                                            <td><?= $row['jenis']; ?></td>
                                            <td><?= $row['saldo']; ?></td>
                                            <td class="text-left">
                                                <a data-id="<?= $row['idKas']; ?>" class="btn btn-primary btnEditKas btn-sm">Edit</a>
                                                <a data-id="<?= $row['idKas']; ?>" class="btn btn-danger btnDeleteKas btn-sm">Delete</a>
                                            </td>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kas</th>
                                        <th>Jenis</th>
                                        <th>Saldo</th>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createKas" name="createKas" action="<?= site_url('kas/store'); ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKas" class="form-label">Nama Kas</label>
                            <input type="text" class="form-control" id="namaKas" name="namaKas" required>
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
                            <input type="number" class="form-control" id="saldo" name="saldo" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModalKas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKasForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNamaKas" class="form-label">Nama Kas</label>
                        <input type="text" class="form-control" id="editNamaKas" name="namaKas" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJenis" class="form-label">Jenis Kas</label>
                        <select name="jenis" id="editJenis" class="form-select">
                            <option value="Bulanan">Bulanan</option>
                            <option value="Mingguan">Mingguan</option>
                            <option value="Insidental">Insidental</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSaldo" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="editSaldo" name="saldo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>