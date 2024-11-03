<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Beranda extends BaseController
{
    public function index(): mixed // Ubah tipe pengembalian menjadi mixed
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            // Jika belum login, alihkan ke halaman login
            return redirect()->to('login');
        }

        // Jika sudah login, tampilkan halaman beranda
        return view('admin/beranda');
    }
}
