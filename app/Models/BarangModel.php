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

    // Menentukan apakah timestamp otomatis diaktifkan
    protected $useTimestamps = true; 
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validasi data untuk memastikan data valid sebelum disimpan
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'merk' => 'required|min_length[2]|max_length[50]',
        'harga' => 'required|numeric',
        'besaran' => 'required|numeric',
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama barang harus diisi.',
            'min_length' => 'Nama barang harus terdiri dari minimal 3 karakter.',
            'max_length' => 'Nama barang maksimal terdiri dari 100 karakter.',
        ],
        'merk' => [
            'required' => 'Merk barang harus diisi.',
            'min_length' => 'Merk barang harus terdiri dari minimal 2 karakter.',
            'max_length' => 'Merk barang maksimal terdiri dari 50 karakter.',
        ],
        'harga' => [
            'required' => 'Harga barang harus diisi.',
            'numeric' => 'Harga barang harus berupa angka.',
        ],
        'besaran' => [
            'required' => 'Besaran barang harus diisi.',
            'numeric' => 'Besaran barang harus berupa angka.',
        ],
    ];

    /**
     * Mengambil semua data barang.
     *
     * @return array
     */
    public function getAllBarang()
    {
        return $this->findAll();
    }

    /**
     * Menyimpan data barang baru.
     *
     * @param array $data
     * @return bool|int
     */
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
