<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "tbl_user";
    protected $primaryKey = "idUser";
    
    protected $returnType = "object";

    protected $allowedFields = [
        'idUser', 'nama', 'username', 'password', 'level', 'status'
    ];

   
}
