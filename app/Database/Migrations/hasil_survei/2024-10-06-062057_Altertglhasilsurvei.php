<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTanggalSurvei extends Migration
{
    public function up()
    {
        // Mengubah kolom Tanggal_survei menjadi tanggal_survei dan menambahkan opsi untuk manual
        $this->forge->modifyColumn('hasil_survei', [
            'Tanggal_survei' => [
                'type' => 'DATE',
                'null' => true, // Mengizinkan null untuk memungkinkan pengisian manual
            ],
        ]);
    }

    public function down()
    {
        // Mengembalikan perubahan
        $this->forge->modifyColumn('hasil_survei', [
            'Tanggal_survei' => [
                'type' => 'DATE',
                'null' => false, // Mengatur ulang ke kondisi sebelumnya
            ],
        ]);
    }
}
