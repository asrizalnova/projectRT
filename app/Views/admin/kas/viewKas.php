<?= $this->extend('Template/Template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4" style="margin-left: 250px;">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Kas</h1>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('kas/tambah'); ?>" class="btn btn-primary me-md-2">+ Kas</a>
            </div>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <!-- Pesan Flashdata -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center">No. Kas</th>
                                        <th class="text-center">Nama Kas</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Saldo</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($daftar_kas as $kas) : ?>
                                        <tr>
                                            <td class="text-center"><?= $kas['idKas']; ?></td>
                                            <td class="text-center"><?= $kas['namaKas']; ?></td>
                                            <td class="text-center"><?= $kas['jenis']; ?></td>
                                            <td class="text-center"><?= $kas['saldo']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('kas/edit/' . $kas['idKas']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= base_url('kas/delete/' . $kas['idKas']); ?>" class="btn btn-danger btn-sm" 
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    Hapus
                                                </a>
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

<?= $this->endSection('content'); ?>
