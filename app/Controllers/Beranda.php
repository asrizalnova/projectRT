<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KKModel;
use App\Models\WargaModel;
use App\Models\KasModel;
use App\Models\PengeluaranModel;
use App\Models\UserModel;
use App\Models\IuranModel;

class Beranda extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $KKModel = new KKModel();
        $WargaModel = new WargaModel();
        $KasModel = new KasModel();
        $PengeluaranModel = new PengeluaranModel();
        $UserModel = new UserModel();
        $IuranModel = new IuranModel();

        $data['kkCount'] = $KKModel->countAll();
        $data['wargaCount'] = $WargaModel->countAll();
        $data['kasCount'] = $KasModel->countAll();
        $data['pengeluaranCount'] = $PengeluaranModel->countAll();
        $data['userCount'] = $UserModel->countAll();
        $data['iuranCount'] = $IuranModel->countAll();

        // Ambil 3 data kas terbaru
        $data['kasPreview'] = $KasModel->orderBy('idKas', 'DESC')->findAll();


        return view('admin/beranda', $data);
    }
}
