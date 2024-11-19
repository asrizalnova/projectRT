<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="<?= base_url() ?>//logoRT.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin RT 16</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="javascript:void(0);" class="d-block">Selamat Datang <b><?= session()->get('nama') ?></b></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('admin'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (session()->get('level') == 'Super Admin'): ?> <!-- Menampilkan menu hanya untuk superadmin -->
                            <li class="nav-item">
                                <a href="<?= base_url('admin/user'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/kk'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kartu Keluarga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/warga'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/kas'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/iuran'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Iuran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/pengeluaran'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Tombol Logout -->
                <li class="nav-item">
                    <a href="#" class="nav-link btnLogout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>