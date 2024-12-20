<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jasa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_item', 'type', 'min_harga', 'max_harga', 'photo_url']; // Menambahkan photo_url

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJasa() {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('type', 'jasa')
                        ->get()
                        ->getResultArray();
    }

    // Metode tambahan untuk mendapatkan semua data jasa
    public function getAllJasa() {
        return $this->findAll();
    }
}
