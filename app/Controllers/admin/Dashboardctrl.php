<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\WargaModel; 
use App\Models\KkModel;

class Dashboardctrl extends BaseController
{
    protected $wargaModel;
    protected $kkModel;

    public function __construct()
    {
        $this->wargaModel = new WargaModel(); 
        $this->KkModel = new KkModel(); 
        
    }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Jika belum login, arahkan ke halaman login
        }

        // Mengambil data untuk ditampilkan di dashboard
        $data = [
            'total_kk' => $this->KkModel->countAll(),
            'total_warga' => $this->wargaModel->countAll(), 
            
        ];

        // Tampilkan view DashboardAdmin.php dengan data
        return view('admin/DashboardAdmin', $data);
    }
}
