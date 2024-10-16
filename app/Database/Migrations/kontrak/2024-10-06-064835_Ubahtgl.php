<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCreatedUpdatedColumnsInKontrak extends Migration
{
    public function up()
    {
        // Mengubah kolom created_at dan updated_at menjadi DATE
        $this->forge->modifyColumn('kontrak', [
            'created_at' => [
                'type' => 'DATE', // Mengubah tipe menjadi DATE
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATE', // Mengubah tipe menjadi DATE
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Mengembalikan kolom ke tipe DATETIME jika rollback
        $this->forge->modifyColumn('kontrak', [
            'created_at' => [
               'type'       => 'DATETIME',
            ],
            'updated_at' => [
               'type'       => 'DATETIME',
            ],
        ]);
    }
}
