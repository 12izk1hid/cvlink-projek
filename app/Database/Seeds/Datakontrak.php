<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataKontrak extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_hasil_survei' => 1,
                'id_user'         => 1,
                'created_at'      => '2024-10-06 ',
                'updated_at'      => '2024-10-07 ',
                'harga'           => 2000000,
            ],
            [
                'id_hasil_survei' => 2,
                'id_user'         => 2,
                'created_at'      => '2024-10-11 ',
                'updated_at'      => '2024-10-12 ',
                'harga'           => 7500000,
            ],
            [
                'id_hasil_survei' => 3,
                'id_user'         => 3,
                'created_at'      => '2024-10-20 ',
                'updated_at'      => '2024-10-21 ',
                'harga'           => 5000000,
            ],
        ];

        // Insert data ke dalam tabel kontrak
        $this->db->table('kontrak')->insertBatch($data);
    }
}
