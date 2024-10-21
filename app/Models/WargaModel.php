<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table = "tbl_warga";
    protected $primaryKey = "nik";

    protected $returnType = "object";

    protected $allowedFields = [
        'nik',
        'noKk',
        'nama',
        'jenisKelamin',
        'tempatLahir',
        'tanggalLahir',
        'status',
        'pekerjaan',
        'keterangan',
        'statusAktif'
    ];

    public function countWarga()
    {
        return $this->countAll(); 
    }
}
