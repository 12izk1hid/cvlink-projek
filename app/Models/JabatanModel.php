<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{

    protected $table = 'tbl_jabatan';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['jabatan', 'userupdate'];

    public function getJabatan()
    {
        return $this->findAll();
    }
}
