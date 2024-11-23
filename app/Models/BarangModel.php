<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    // Nama tabel di database
    protected $table = 'barang'; 
    
    // Primary key tabel
    protected $primaryKey = 'id'; 
    
    // Kolom-kolom yang dapat diisi
    protected $allowedFields = ['nama', 'merk', 'harga', 'besaran']; 

    // Validasi data untuk memastikan data valid sebelum disimpan
    protected $validationRules = [
        'nama' => 'required|max_length[100]',
        'merk' => 'required|max_length[50]',
        'harga' => 'required|numeric',
        'besaran' => 'required|max_length[100]',
    ];

    public function getAllBarang()
    {
        return $this->findAll();
    }

    public function saveBarang(array $data)
    {
        return $this->save($data);
    }

    /**
     * Mengambil data barang berdasarkan ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getBarangById(int $id)
    {
        return $this->find($id);
    }

    /**
     * Memperbarui data barang berdasarkan ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateBarang(int $id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Menghapus data barang berdasarkan ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBarang(int $id)
    {
        return $this->delete($id);
    }
}
