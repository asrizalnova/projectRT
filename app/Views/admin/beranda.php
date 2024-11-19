<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<style>
    .small-box-footer {
    display: block;
    padding: 10px 20px;  /* Menambahkan padding agar ukuran footer tetap simetris */
    text-align: center;
    font-size: 14px;
    color: #0000;
    text-decoration: none;
    height: 30px;  /* Pastikan ketinggian footer tetap sesuai dengan box lainnya */
    line-height: 20px; /* Menjaga teks berada di tengah */
    background: rgba(0,0,0,.1);  /* Menambahkan sedikit latar belakang agar footer lebih jelas */
}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h2>KK</h2>
                            <h4>Jumlah Kk terdaftar :  <?= $kkCount; ?></h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?= base_url('/kk') ?>" class="small-box-footer">Info Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h2>Warga RT</h2>
                        <h4>Jumlah Warga terdaftar :  <?= $wargaCount; ?></h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?= base_url('/warga') ?>" class="small-box-footer">Info Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h2>User aplikasi</h2>
            <h4>Jumlah User terdaftar :  <?= $userCount; ?></h4>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="javascript:void(0)" class="small-box-footer">
            <!-- Footer tetap ada tanpa icon arrow -->
        </a>
    </div>
</div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h2>Jumlah Kas</h2>
                        <h4>Jumlah Kas sejauh ini :  <?= $kasCount; ?></h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="kas" class="small-box-footer">Info Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>


            <div class="row">
    <!-- Preview Data Kas -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Preview Data Kas</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kas</th>
                            <th>Jenis</th>
                            <th>Jumlah Pemasukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kasPreview)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($kasPreview as $kas): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $kas['namaKas']; ?></td>
                                    <td><?= $kas['jenis']; ?></td>
                                    <td><?= number_format($kas['saldo'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Data kas tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




            <!-- /.row -->
            <!-- Main row -->
                    

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>

<?= $this->endSection(); ?>