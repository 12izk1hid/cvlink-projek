<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Datajasa extends Seeder
{
    public function run()
    {
        // Data yang akan dimasukkan
        $data = [
            [
                'nama_item' => 'Instalasi Listrik',
                'type'      => 'Instalasi',
                'min_harga' => 1500000, // menggunakan format integer
                'max_harga' => 3000000,
            ],
            [
                'nama_item' => 'Pengeboran Tanah',
                'type'      => 'Instalasi',
                'min_harga' => 5000000,
                'max_harga' => 10000000,
            ],
            [
                'nama_item' => 'Instalasi CCTV',
                'type'      => 'Instalasi',
                'min_harga' => 3000000,
                'max_harga' => 7000000,
            ],
        ];

        // Menyisipkan data ke dalam tabel jasa
        $this->db->table('jasa')->insertBatch($data);
    }
}
