<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'tbl_users';
    protected $primaryKey = 'username';
    //field yang akan di tampilkan
    protected $allowedFields = ['username', 'nama', 'password'];

    protected $userTimestamps = true;

    public function getUser($username = false, $password = false)
    {
        $builder = $this->db->table('tbl_users');
        $builder->select('*');
        $builder->join('tbl_leveluser', 'tbl_leveluser.id = tbl_users.id_level');
        if ($username  and $password) {
            $builder->where('username', $username);
            $builder->where('password', $password);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
}
