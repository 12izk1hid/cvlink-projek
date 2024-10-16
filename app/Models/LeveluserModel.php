<?php

namespace App\Models;

use CodeIgniter\Model;

class LeveluserModel extends Model
{

    protected $table = 'tbl_leveluser';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['level', 'userupdate'];

    public function getLeveluser()
    {
        return $this->findAll();
    }
}
