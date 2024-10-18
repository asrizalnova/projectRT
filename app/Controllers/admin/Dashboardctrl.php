<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboardctrl extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Jika belum login, arahkan ke halaman login
        }

        // Tampilkan view DashboardAdmin.php
        return view('admin/DashboardAdmin');
    }
}
