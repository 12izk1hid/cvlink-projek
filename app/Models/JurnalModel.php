<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{

    protected $table = 'tbl_jurnal';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['tgltransaksi', 'ket', 'saldoawal', 'debet', 'kredit', 'referensi', 'usercreate'];

    public function getJurnal()
    {
        return $this->findAll();
    }
}
