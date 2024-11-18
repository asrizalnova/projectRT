<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = "tbl_pengeluaran";
    protected $primaryKey = 'idPengeluaran';
    protected $allowedFields = [
        'idUser',
        'idKas',
        'namaPengeluaran',
        'int',
        'tanggal'
    ];

    // public function getIuranWithRelations()
    // {
    //     return $this->select('tbl_iuran.*, tbl_user.username, tbl_kas.namaKas')
    //         ->join('tbl_user', 'tbl_user.idUser = tbl_iuran.idUser')
    //         ->join('tbl_kas', 'tbl_kas.idKas = tbl_iuran.idKas')
    //         ->orderBy('tbl_iuran.idIuran')
    //         ->findAll();
    // }

    // Tidak perlu constructor custom karena Model sudah otomatis mengatur koneksi database
}
