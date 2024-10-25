<?= $this->extend('Template/Template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Warga</h1>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?php echo base_url() .    "warga/tambah" ?>" class="btn btn-primary me-md-2"> + Tambah Warga</a>
            </div>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">No KK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tempat Lahir</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Umur</th> <!-- Tambahkan kolom Umur -->
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Pekerjaan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Status Aktif</th>
                                        <th class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data_warga as $tampilWarga) : ?>
                                        <tr>
                                            <td><?= $tampilWarga->nik ?></td>
                                            <td><?= $tampilWarga->noKk ?></td>
                                            <td><?= $tampilWarga->nama ?></td>
                                            <td><?= $tampilWarga->jenisKelamin ?></td>
                                            <td><?= $tampilWarga->tempatLahir ?></td>
                                            <td><?= $tampilWarga->tanggalLahir ?></td>
                                            <td><?= $tampilWarga->umur ?></td> <!-- Tampilkan umur yang sudah dihitung -->
                                            <td><?= $tampilWarga->status ?></td>
                                            <td><?= $tampilWarga->pekerjaan ?></td>
                                            <td><?= $tampilWarga->keterangan ?></td>
                                            <td><?= $tampilWarga->statusAktif ?></td>
                                            <td valign="middle">
                                                <div class="d-grid gap-2 d-md-grid" style="grid-template-columns: 1fr 1fr;">
                                                    <a href="<?= base_url('warga/edit/' . $tampilWarga->nik) ?>" class="btn btn-warning mb-2">Edit</a>
                                                    <a href="<?= base_url('warga/delete') . '/' . $tampilWarga->nik ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $tampilWarga->nik ?>">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($all_data_warga as $tampilWarga) : ?>
    <div class="modal fade" id="deleteModal<?= $tampilWarga->nik ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $tampilWarga->nik ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $tampilWarga->nik ?>">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('/warga/delete/' . $tampilWarga->nik) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<?= $this->endSection('content'); ?>