<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Invoice extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kontrak' => 1,
                'harga' => 2000000,
                'status' => 'Selesai',
            ],
            [
                'id_kontrak' => 2,
                'harga' => 7500000,
                'status' => 'Selesai',
            ],
            [
                'id_kontrak' => 3,
                'harga' => 5000000,
                'status' => 'Selesai',
            ],
        ];

        // Menyimpan data ke tabel invoice
        foreach ($data as $invoice) {
            $this->db->table('invoice')->insert($invoice);
        }
    }
}
