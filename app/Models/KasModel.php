<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table = "tbl_kas";
    protected $primaryKey = 'idKas';
    protected $allowedFields = [
        'namaKas',
        'jenis',
        'saldo'
    ];

    // Tidak perlu constructor custom karena Model sudah otomatis mengatur koneksi database
}
