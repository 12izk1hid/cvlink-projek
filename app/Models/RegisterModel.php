<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'username', 'password', 'alamat', 'email', 'no_hp', 'role'];

    public function getUserByRole($role) {
        // dd($role);
        return $this->db->table('users')
                      ->select('*') 
                      ->where('role', $role)  
                      ->get()
                      ->getResultArray();
}
}