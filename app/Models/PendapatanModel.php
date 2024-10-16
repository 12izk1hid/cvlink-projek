<?php

namespace App\Models;

use CodeIgniter\Model;

class PendapatanModel extends Model
{

    protected $table = 'tbl_pendapatan';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['tglpendapatan', 'invoice_num', 'keterangan', 'jumlah', 'usercreate'];

    public function getPendapatan()
    {
        return $this->findAll();
    }
}
