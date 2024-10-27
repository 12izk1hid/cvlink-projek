<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoice';
    protected $primaryKey       = 'id_kontrak';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_kontrak', 'harga', 'Status'];

    // Fungsi untuk mengambil data id dari pengguna yang role-nya surveyor
    public function getKontrak()
    {
        return $this->db->table('kontrak')
                        ->select('id','harga')                
                        ->get()
                        ->getResultArray();  
    }
    public function getHargaByKontrak($id_kontrak) {
        return $this->db->table('nama_tabel')
                        ->select('harga')
                        ->where('id_kontrak', $id_kontrak)
                        ->get()
                        ->getRowArray(); // Pastikan ini mengembalikan row yang sesuai
    }
    
}

