<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'tbl_kategori';   // Nama tabel di database
    protected $primaryKey       = 'id_k';           // Primary key dari tabel
    protected $useAutoIncrement = true;             // Menggunakan auto increment untuk primary key
    protected $returnType       = 'array';          // Mengembalikan data dalam bentuk array
    protected $allowedFields    = ['kategori'];     // Field yang diizinkan untuk insert/update

    // Fungsi untuk mendapatkan semua data kategori
    public function getKategori()
    {
        return $this->select('id_k, kategori')->findAll();  // Pastikan id_k dan kategori diambil
    }
}
