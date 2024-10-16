<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'nama', 'password', 'id_level', 'aktif', 'idupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_create';
    protected $updatedField  = 'tgl_update';
    protected $deletedField  = 'deleted_at';

    public function getUser($username = false, $password = false)
    {
        $builder = $this->db->table('tbl_users');
        $builder->select('*');
        $builder->join('tbl_leveluser', 'tbl_leveluser.id_level = tbl_users.id_level');
        if ($username  and $password) {
            $builder->where('username', $username);
            $builder->where('password', $password);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
}
