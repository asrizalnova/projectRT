<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\WargaModel; 
use App\Models\KkModel;
use App\Models\KasModel;

class Dashboardctrl extends BaseController
{
    protected $wargaModel;
    protected $kkModel;
    protected $kasModel;

    public function __construct()
    {
        $this->wargaModel = new WargaModel(); 
        $this->KkModel = new KkModel(); 
        $this->kasModel = new kasModel();
        
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
            'total_kas' => $this->kasModel->getTotalSaldo(),
        ];

        // Tampilkan view DashboardAdmin.php dengan data
        return view('admin/DashboardAdmin', $data);
    }
}
