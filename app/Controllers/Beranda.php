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
            return redirect()->to(base_url('login'));
        }

        $KasModel = new KasModel();
        $IuranModel = new IuranModel();
        $PengeluaranModel = new PengeluaranModel();

        $data['kkCount'] = (new KKModel())->countAll();
        $data['wargaCount'] = (new WargaModel())->countAll();
        $data['kasCount'] = $KasModel->countAll();
        $data['pengeluaranCount'] = $PengeluaranModel->countAll();
        $data['userCount'] = (new UserModel())->countAll();
        $data['iuranCount'] = $IuranModel->countAll();

        // Ambil 3 data kas terbaru dan hitung jumlah pemasukan dan pengeluaran untuk setiap idKas
        $data['kasPreview'] = $KasModel
            ->select('tbl_kas.*, 
                  SUM(tbl_iuran.jumlah) AS total_iuran, 
                  SUM(tbl_pengeluaran.int) AS total_pengeluaran')
            ->join('tbl_iuran', 'tbl_kas.idKas = tbl_iuran.idKas', 'left')
            ->join('tbl_pengeluaran', 'tbl_kas.idKas = tbl_pengeluaran.idKas', 'left')
            ->groupBy('tbl_kas.idKas')
            ->orderBy('tbl_kas.idKas', 'DESC')
            ->findAll();

        return view('admin/beranda', $data);
    }
}
