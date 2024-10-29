<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['username', 'harga', 'status'];

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
                        ->getResultArray(); // Pastikan ini mengembalikan row yang sesuai
    }

    public function getIdUnsurveyedInvoice() {
        return array_column(
            $this->db->table('invoice')
                ->select('id')
                ->where('status', 'unsurveyed')
                ->get()
                ->getResultArray(),
            'id'
        );
        
    }

    public function getData() {
        return $this->db->table('invoice')
                ->select('invoice.*, users.nama as nama_user')
                ->join('users', 'users.username = invoice.username')
                ->get()
                ->getResultArray();
    }
    
}

