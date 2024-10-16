<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{

    protected $table = 'tbl_kas';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['total', 'userid'];

    public function getKas()
    {
        $builder = $this->db->table('tbl_kas');
        $query = $builder->where('id', '1');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
