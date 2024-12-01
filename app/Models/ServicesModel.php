<?php
namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'services';  // Nama tabel
    protected $primaryKey       = 'id';        // Primary key
    protected $useAutoIncrement = true;        // Auto increment
    protected $returnType       = 'array';     // Return type array
    protected $useSoftDeletes   = false;       // Soft deletes tidak digunakan
    protected $protectFields    = true;        // Melindungi field
    protected $allowedFields    = ['nama', 'deskripsi', 'harga', 'img_url']; // Kolom yang bisa diubah

    protected $validationRules = [
        'nama'       => 'required|max_length[255]',
        'deskripsi'  => 'required|max_length[500]',
        'harga'      => 'required|numeric',
        'img_url'    => 'permit_empty|valid_url',  // Memungkinkan kosong, jika ada URL gambar
    ];

    protected $validationMessages = [
        'nama' => ['required' => 'Nama jasa harus diisi.'],
        'deskripsi' => ['required' => 'Deskripsi harus diisi.'],
        'harga' => ['required' => 'Harga harus diisi.', 'numeric' => 'Harga harus berupa angka.'],
        'img_url' => ['valid_url' => 'URL gambar tidak valid.'],
    ];
}
