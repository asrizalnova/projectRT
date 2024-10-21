<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{
    protected $table = "tbl_kk";
    protected $primaryKey = 'noKK';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['noKK', 'namaKK', 'status'];

    protected $validationRules    = [
        'noKK'   => 'required|exact_length[16]',
        'namaKK' => 'required|max_length[45]',
        'status' => 'required|in_list[menetap,pindah]',
    ];

    protected $validationMessages = [
        'noKK'   => [
            'required' => 'No KK harus diisi',
            'exact_length' => 'No KK harus terdiri dari 16 karakter',
        ],
        'namaKK' => [
            'required' => 'Nama KK harus diisi',
            'max_length' => 'Nama KK maksimal 45 karakter',
        ],
        'status' => [
            'required' => 'Status harus diisi',
            'in_list' => 'Status harus memilih antara "menetap" atau "pindah"',
        ],
    ];

    public function countWarga()
    {
        return $this->countAll(); 
    }
}
