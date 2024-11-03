<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{
    protected $table = "tbl_kk";
    protected $primaryKey = 'noKK';
    protected $allowedFields = [
        'noKK',
        'namaKK',
        'status'
    ];

    public function countWarga()
    {
        return $this->countAll();
    }
}
