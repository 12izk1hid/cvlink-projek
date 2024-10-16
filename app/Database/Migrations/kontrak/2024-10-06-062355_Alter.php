<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCreatedAtUpdatedAtKontrak extends Migration
{
    public function up()
    {
        // Mengubah kolom created_at dan updated_at untuk memungkinkan pengisian manual
        $this->forge->modifyColumn('kontrak', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Mengizinkan null untuk memungkinkan pengisian manual
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true, // Mengizinkan null untuk memungkinkan pengisian manual
            ],
        ]);
    }

    public function down()
    {
        // Mengembalikan perubahan ke kondisi sebelumnya jika diperlukan
        $this->forge->modifyColumn('kontrak', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false, // Mengatur ulang ke kondisi sebelumnya
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false, // Mengatur ulang ke kondisi sebelumnya
            ],
        ]);
    }
}
