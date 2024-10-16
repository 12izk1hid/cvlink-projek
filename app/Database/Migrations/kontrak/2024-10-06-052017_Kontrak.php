<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontrakTable extends Migration
{
    public function up()
    {
        // Menambahkan field untuk tabel kontrak
        $this->forge->addField([
            'id_kontrak'         => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_hasil_survei'    => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'id_user'            => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'created_at'         => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => date('Y-m-d H:i:s'), // Mengatur default ke waktu saat ini
            ],
            'updated_at'         => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => date('Y-m-d H:i:s'), // Mengatur default ke waktu saat ini
            ],
            'harga'              => [
                'type'       => 'FLOAT',
                'null'       => false,
            ],
        ]);

        // Menambahkan Primary Key
        $this->forge->addKey('id_kontrak', true);

        // Membuat tabel
        $this->forge->createTable('kontrak');

        // Menambahkan Foreign Key
        $this->forge->addForeignKey('id_hasil_survei', 'hasil_survei', 'id_hasil_survei', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Menghapus tabel jika migrasi dibatalkan
        $this->forge->dropTable('kontrak');
    }
}
