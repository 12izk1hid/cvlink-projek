<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pemasangan extends Seeder
{
    public function run()
    {
        // Data pemasangan
        $data = [
            [
                'id_kontrak'        => 1,
                'tanggal_mulai'     => '2024-10-08',
                'tanggal_selesai'   => '2024-10-11',
                'status_pemasangan' => 'completed',
                'id_user'           => 4,
                'catatan_pemasangan' => 'Tidak ada kendala'
            ],
            [
                'id_kontrak'        => 2,
                'tanggal_mulai'     => '2024-10-13',
                'tanggal_selesai'   => '2024-10-19',
                'status_pemasangan' => 'completed',
                'id_user'           => 5,
                'catatan_pemasangan' => 'Tidak Ada Kendala'
            ],
            [
                'id_kontrak'        => 3,
                'tanggal_mulai'     => '2024-10-22',
                'tanggal_selesai'   => '2024-10-22',
                'status_pemasangan' => 'completed',
                'id_user'           => 6,
                'catatan_pemasangan' => 'Tidak Ada Kendala'
            ]
        ];

        // Menyimpan data ke tabel pemasangan
        foreach ($data as $row) {
            $this->db->table('pemasangan')->insert($row);
        }
    }
}
