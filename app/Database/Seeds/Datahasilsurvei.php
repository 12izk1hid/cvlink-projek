<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Datahasilsurvei extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user'              => 1, // Ganti sesuai dengan id_user yang ada
                'Tanggal_survei'       => '2024-10-05',
                'Jenis_instalasi'      => 'Instalasi Listrik',
                'kebutuhan_material'    => 'Kabel 4m, 1 unit saklar',
                'estimasi_waktu'       => '3 hari',
                'catatan_hasil_survei' => 'Semua material tersedia',
            ],
            [
                'id_user'              => 2, // Ganti sesuai dengan id_user yang ada
                'Tanggal_survei'       => '2024-10-10',
                'Jenis_instalasi'      => 'Pengeboran',
                'kebutuhan_material'    => '1 unit bor, 2 unit cangkul',
                'estimasi_waktu'       => '6 hari',
                'catatan_hasil_survei' => 'Sumber air sudah ditemukan',
            ],
            [
                'id_user'              => 3, // Ganti sesuai dengan id_user yang ada
                'Tanggal_survei'       => '2024-10-19',
                'Jenis_instalasi'      => 'Instalasi CCTV',
                'kebutuhan_material'    => '5 unit cctv',
                'estimasi_waktu'       => '1 hari',
                'catatan_hasil_survei' => 'Material masih kurang',
            ],
        ];

        // Menginsert data ke tabel hasil_survei
        foreach ($data as $row) {
            $this->db->table('hasil_survei')->insert($row);
        }
    }
}
