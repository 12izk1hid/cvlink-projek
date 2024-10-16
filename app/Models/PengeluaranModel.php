<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{

    protected $table = 'tbl_pengeluaran';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['tglpengeluaran', 'acc_no', 'keterangan', 'jumlah', 'usercreate'];

    public function getPengeluaran()
    {
        return $this->findAll();
    }
}
