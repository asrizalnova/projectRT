<?= $this->extend('Template/Template'); ?>
<?= $this->section('content'); ?>

<body>
    <?= $this->include('admin/Layout/Navbar.php'); ?>
    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo atau header lainnya -->
            </div>

            <div class="container">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Dashboard</h3>
                        <h6 class="op-7 mb-2">Selamat Datang Di Website Kas RT</h6>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-6 col-md-2 mb-2"> <!-- Lebar kartu kecil -->
                        <div class="card" style="border-radius: 10px; padding: 5px; width: auto; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                            <div class="card-body p-2 text-center">
                                <a href="<?= base_url('kk'); ?>" style="text-decoration: none; color: inherit;">
                                    <p class="card-category mb-1" style="font-size: 14px;">Total KK</p>
                                    <h4 class="card-title" style="font-size: 18px;"><?= $total_kk; ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 mb-2">
                        <div class="card" style="border-radius: 10px; padding: 5px; width: auto; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                            <div class="card-body p-2 text-center">
                                <a href="<?= base_url('warga'); ?>" style="text-decoration: none; color: inherit;">
                                    <p class="card-category mb-1" style="font-size: 14px;">Total Warga</p>
                                    <h4 class="card-title" style="font-size: 18px;"><?= $total_warga; ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 mb-2"> <!-- Kartu baru untuk saldo kas -->
                        <div class="card" style="border-radius: 10px; padding: 5px; width: auto; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                            <div class="card-body p-2 text-center">
                                <a href="<?= base_url('kas'); ?>" style="text-decoration: none; color: inherit;">
                                    <p class="card-category mb-1" style="font-size: 14px;">Saldo Kas</p>
                                    <h4 class="card-title" style="font-size: 18px;"><?= number_format($total_kas, 2, ',', '.'); ?></h4> <!-- Format saldo dengan 2 desimal -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Tutup row -->
            </div> <!-- Tutup container -->
        </div>
    </div>
</body>

<?= $this->endSection('content'); ?>
