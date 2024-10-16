<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalbankModel extends Model
{

    protected $table = 'tbl_jurnalbank';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['tgltransaksi', 'ket', 'saldoawal', 'debet', 'kredit', 'referensi', 'usercreate'];

    public function getCahsBank()
    {
        return $this->findAll();
    }
}
