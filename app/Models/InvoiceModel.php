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
    protected $allowedFields = ['user_username', 'tanggal_pemesanan', 'checkout'];

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
                ->select('invoice.*, s.nama as nama_user, t.nama as teknisi, r.nama as surveyor')
                ->join('users s', 's.username = invoice.username')
                ->join('users t', 't.username = invoice.id_teknisi', 'left')
                ->join('users r', 'r.username = invoice.id_surveyor', 'left')
                ->get()
                ->getResultArray();
    }
    
}

