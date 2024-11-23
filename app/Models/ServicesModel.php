<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'services';  // Nama tabel di database
    protected $primaryKey       = 'id';        // Primary key untuk tabel
    protected $useAutoIncrement = true;        // Otomatis menambah ID
    protected $returnType       = 'array';     // Mengembalikan data dalam bentuk array
    protected $useSoftDeletes   = false;       // Menggunakan soft deletes (opsional)
    protected $protectFields    = true;        // Melindungi field untuk keamanan
    protected $allowedFields    = ['nama', 'deskripsi', 'img_url', 'harga'];  // Kolom yang dapat diubah

    // Optional: Menambahkan validasi atau metode tambahan jika diperlukan
    // Contoh: validasi untuk gambar yang diupload
    protected $validationRules = [
        'nama'       => 'required|max_length[255]', // Validasi nama
        'deskripsi'  => 'required|max_length[500]', // Validasi deskripsi
        'img_url'    => 'permit_empty|valid_url',  // Validasi untuk img_url, jika kosong tidak masalah
        'harga'      => 'required|numeric',        // Validasi harga, harus angka
    ];

    protected $validationMessages = [
        'nama' => [
            'required'    => 'Nama jasa harus diisi.',
            'max_length'  => 'Nama jasa maksimal 255 karakter.',
        ],
        'deskripsi' => [
            'required'    => 'Deskripsi harus diisi.',
            'max_length'  => 'Deskripsi maksimal 500 karakter.',
        ],
        'img_url' => [
            'valid_url'   => 'URL gambar tidak valid.',
        ],
        'harga' => [
            'required'    => 'Harga harus diisi.',
            'numeric'     => 'Harga harus berupa angka.',
        ],
    ];

    // Jika ingin menambahkan fitur soft delete, aktifkan properti berikut
    // protected $useSoftDeletes = true;

    // Jika Anda membutuhkan timestamp otomatis (created_at dan updated_at), aktifkan properti ini
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
