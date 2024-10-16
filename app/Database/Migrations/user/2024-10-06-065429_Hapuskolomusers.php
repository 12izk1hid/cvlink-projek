<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropCreatedAndUpdatedFromUsers extends Migration
{
    public function up()
    {
        // Menghapus kolom created_at dan updated_at dari tabel users
        $this->forge->dropColumn('users', ['created_at', 'updated_at']);
    }

    public function down()
    {
        // Jika rollback, tambahkan kembali kolom created_at dan updated_at
        $this->forge->addColumn('users', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);
    }
}
