<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTanggalInPemasangan extends Migration
{
    public function up()
    {
        // Mengubah kolom tanggal_mulai dan tanggal_selesai menjadi DATE
        $this->forge->modifyColumn('pemasangan', [
            'tanggal_mulai' => [
                'type' => 'DATE', // Mengubah tipe menjadi DATE
                'null' => true,
            ],
            'tanggal_selesai' => [
                'type' => 'DATE', // Mengubah tipe menjadi DATE
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Mengembalikan kolom ke tipe DATETIME jika rollback
        $this->forge->modifyColumn('pemasangan', [
            'tanggal_mulai' => [
                'type' => 'DATETIME',
                
            ],
            'tanggal_selesai' => [
                'type' => 'DATETIME',
                
            ],
        ]);
    }
}
