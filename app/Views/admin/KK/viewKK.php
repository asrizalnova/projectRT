<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AdminKasRT16</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <link
        rel="icon"
        href="/Assets/assets/img/kaiadmin/favicon.ico"
        type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/Assets/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/Assets/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Assets/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/Assets/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/Assets/assets/css/demo.css" />

    <style>
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }

        h2 {
            text-align: center;
            color: #2980B9;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2980B9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-create {
            background-color: #2980B9;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-create:hover {
            background-color: #3498DB;
        }
    </style>

</head>

<body>
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">

            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img
                        src="<?= base_url('Assets'); ?>/picture/LogoRT.png"
                        alt="navbar brand"
                        class="navbar-brand"
                        height="40" />/>
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item active">
                        <a
                            data-bs-toggle="collapse"
                            href="#dashboard"
                            class="collapsed"
                            aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="dashboard">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../demo1/index.html">
                                        <span class="sub-item">Dashboard 1</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">MENU</h4>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Menu</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url('/kk'); ?>">
                                        <span class="sub-item">Data KK</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/buttons.html">
                                        <span class="sub-item">Data Warga</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/gridsystem.html">
                                        <span class="sub-item">Data Kas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/panels.html">
                                        <span class="sub-item">Data Pengeluaran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">

            </div>
            <!-- Navbar Header -->
            <nav
                class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav
                        class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pe-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input
                                type="text"
                                placeholder="Search ..."
                                class="form-control" />
                        </div>
                    </nav>

                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a
                                class="dropdown-toggle profile-pic"
                                data-bs-toggle="dropdown"
                                href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img
                                        src="assets/img/profile.jpg"
                                        alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">Hizrian</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img
                                                    src="assets/img/profile.jpg"
                                                    alt="image profile"
                                                    class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                <p class="text-muted">hello@example.com</p>
                                                <a
                                                    href="profile.html"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">My Balance</a>
                                        <a class="dropdown-item" href="#">Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <div class="container">
            <div class="page-inner">
                <div
                    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Dashboard</h3>
                        <h6 class="op-7 mb-2">Selamat Datang Di Website Kas RT</h6>
                    </div>
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                        <a href="#" class="btn btn-primary btn-round">Add Customer</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Visitors</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Subscribers</p>
                                            <h4 class="card-title">1303</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-luggage-cart"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Sales</p>
                                            <h4 class="card-title">$ 1,345</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Order</p>
                                            <h4 class="card-title">576</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h2>Daftar Kartu Keluarga (KK)</h2>

                    <!-- Pesan Flashdata -->
                    <?php if (session()->getFlashdata('message')) : ?>
                        <div class="message"><?= session()->getFlashdata('message') ?></div>
                    <?php endif; ?>

                    <!-- Tabel Daftar Kartu Keluarga -->
                    <table>
                        <thead>
                            <tr>
                                <th>No. KK</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop untuk data KK -->
                            <?php foreach ($kartu_keluarga as $kk) : ?>
                                <tr>
                                    <td><?= $kk['noKK']; ?></td>
                                    <td><?= $kk['namaKK']; ?></td>
                                    <td><?= $kk['status']; ?></td>
                                    <td>
                                        <a href="<?= base_url('kk/edit/' . $kk['noKK']); ?>">Edit</a> |
                                        <a href="<?= base_url('kk/delete/' . $kk['noKK']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Tombol Tambah Data -->
                    <a href="<?= base_url('kk/create'); ?>" class="btn-create">Tambah Kartu Keluarga</a>
                </div>
            </div>
        </div>



        <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="http://www.themekita.com">
                                ThemeKita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> Help </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> Licenses </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    2024, made with <i class="fa fa-heart heart text-danger"></i> by
                    <a href="http://www.themekita.com">ThemeKita</a>
                </div>
                <div>
                    Distributed by
                    <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                </div>
            </div>
        </footer>
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="selected changeLogoHeaderColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="blue"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="purple"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="light-blue"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="green"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="orange"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="red"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="white"></button>
                        <br />
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="dark2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="blue2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="purple2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="light-blue2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="green2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="orange2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="blue"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="purple"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="light-blue"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="green"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="orange"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="red"></button>
                        <button
                            type="button"
                            class="selected changeTopBarColor"
                            data-color="white"></button>
                        <br />
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="dark2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="blue2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="purple2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="light-blue2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="green2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="orange2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="changeSideBarColor"
                            data-color="white"></button>
                        <button
                            type="button"
                            class="selected changeSideBarColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="changeSideBarColor"
                            data-color="dark2"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="icon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="/Assets/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="/Assets/assets/js/core/popper.min.js"></script>
    <script src="/Assets/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/Assets/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="/Assets/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="/Assets/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="/Assets/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="/Assets/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="/Assets/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="/Assets/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="/Assets/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="/Assets/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="/Assets/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>