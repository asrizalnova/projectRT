<?php

namespace App\Models;

use CodeIgniter\Model;

class IuranModel extends Model
{
    protected $table = "tbl_iuran";
    protected $primaryKey = 'idIuran';
    protected $allowedFields = [
        'idUser',
        'idKas',
        'noKK',
        'bulan',
        'tahun',
        'jumlah',
        'tanggal'
    ];

    public function getIuranWithRelations()
    {
        return $this->select('tbl_iuran.*, tbl_user.username, tbl_kas.namaKas, tbl_kk.noKk')
            ->join('tbl_user', 'tbl_user.idUser = tbl_iuran.idUser')
            ->join('tbl_kas', 'tbl_kas.idKas = tbl_iuran.idKas')
            ->join('tbl_kk', 'tbl_kk.noKk = tbl_iuran.noKk')
            ->orderBy('tbl_iuran.idIuran')
            ->findAll();
    }

    // Tidak perlu constructor custom karena Model sudah otomatis mengatur koneksi database
}
