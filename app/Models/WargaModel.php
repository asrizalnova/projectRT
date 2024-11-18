<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table = "tbl_warga";
    protected $primaryKey = 'nik';
    protected $allowedFields = [
        'nik',
        'noKK',
        'nama',
        'jenisKelamin',
        'tempatLahir',
        'tanggalLahir',
        'status',
        'pekerjaan',
        'keterangan',
        'statusAktif'
    ];

    // Tidak perlu constructor custom karena Model sudah otomatis mengatur koneksi database
}
