<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropKontrakTable extends Migration
{
    public function up()
    {
        // Menghapus tabel kontrak
        $this->forge->dropTable('kontrak', true);
    }

    public function down()
    {
        // Jika Anda ingin mengembalikannya, tambahkan kode untuk membuat kembali tabel kontrak
        // Misalnya, panggil kembali migrasi tabel kontrak yang asli
    }
}
