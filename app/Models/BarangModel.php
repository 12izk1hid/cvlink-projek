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
    protected $allowedFields = ['nama_barang', 'merk', 'harga', 'besaran']; // Sesuaikan nama kolom
    
    

    // Validasi data untuk memastikan data valid sebelum disimpan
    protected $validationRules = [
        'nama_barang' => 'required|max_length[100]',  // Sesuaikan nama kolom
        'merk'        => 'required|max_length[50]',
        'harga'       => 'required|numeric',
        'besaran'     => 'required|max_length[100]',
    ];

    // Validasi pesan (opsional, untuk kustomisasi pesan error)
    protected $validationMessages = [
        'nama_barang' => [  // Sesuaikan nama kolom
            'required'   => 'Nama barang wajib diisi.',
            'max_length' => 'Nama barang maksimal 100 karakter.',
        ],
        'merk' => [
            'required'   => 'Merk barang wajib diisi.',
            'max_length' => 'Merk barang maksimal 50 karakter.',
        ],
        'harga' => [
            'required' => 'Harga barang wajib diisi.',
            'numeric'  => 'Harga barang harus berupa angka.',
        ],
        'besaran' => [
            'required'   => 'Besaran barang wajib diisi.',
            'max_length' => 'Besaran barang maksimal 100 karakter.',
        ],
    ];

    /**
     * Mengambil semua data barang.
     *
     * @return array|null
     */
    public function getAllBarang()
    {
        // Debugging untuk menampilkan semua data barang (hapus setelah debugging)
        // dd($this->findAll());

        // Mengembalikan semua data barang
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
        if (!$this->validate($data)) {
            // Kembalikan pesan error jika validasi gagal
            return $this->errors();
        }
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
        if (!$this->validate($data)) {
            // Kembalikan pesan error jika validasi gagal
            return $this->errors();
        }
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
