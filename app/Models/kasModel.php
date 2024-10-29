<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table = "tbl_kas";
    protected $primaryKey = 'idKas';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['namaKas', 'jenis', 'saldo'];

    protected $validationRules    = [
        'namaKas' => 'required|max_length[100]',
        'jenis'   => 'required|in_list[Bulanan,Mingguan,Insidental]',
        'saldo'   => 'required|integer',
    ];

    protected $validationMessages = [
        'namaKas' => [
            'required'   => 'Nama Kas harus diisi',
            'max_length' => 'Nama Kas maksimal 100 karakter',
        ],
        'jenis' => [
            'required' => 'Jenis harus diisi',
            'in_list'  => 'Jenis harus memilih antara "Bulanan", "Mingguan", atau "Insidental"',
        ],
        'saldo' => [
            'required' => 'Saldo harus diisi',
            'integer'  => 'Saldo harus berupa angka bulat',
        ],
    ];

    public function getTotalSaldo()
    {
        $builder = $this->builder();
        $builder->selectSum('saldo');
        $query = $builder->get();
        $result = $query->getRow();

        return $result->saldo; // Pastikan ini mengembalikan nilai numerik tunggal
    }
}
