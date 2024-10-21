<?php 
// Tambahkan di awal file sidebar.php untuk mendapatkan URL path aktif
$currentPath = uri_string(); 
?>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url('admin/dashboard'); ?>" class="logo">
                <img src="<?= base_url('Assets/picture/LogoRT.png') ?>" 
                     alt="navbar brand" class="navbar-brand" height="40" />
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
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Dashboard -->
                <li class="nav-item <?= ($currentPath == 'admin/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">
                        <i class="fa fa-home me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Menu Section -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">MENU</h4>
                </li>

                <!-- Data KK -->
                <li class="nav-item <?= ($currentPath == 'kk') ? 'active' : '' ?>">
                    <a href="<?= base_url('kk'); ?>" class="nav-link">
                        <i class="fas fa-file"></i>
                        <span>Data KK</span>
                    </a>
                </li>

                <!-- Tes -->
                <li class="nav-item <?= ($currentPath == 'tes') ? 'active' : '' ?>">
                    <a href="<?= base_url('/warga'); ?>" class="nav-link">
                        <i class="fas fa-file"></i>
                        <span>Warga</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
