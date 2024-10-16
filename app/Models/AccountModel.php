<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{

    protected $table = 'tbl_accountname';
    protected $primaryKey = 'acc_no';
    //field yang akan di tampilkan
    protected $allowedFields = ['acc_no', 'account_name', 'userupdate'];

    public function getAccount()
    {
        return $this->findAll();
    }
}
