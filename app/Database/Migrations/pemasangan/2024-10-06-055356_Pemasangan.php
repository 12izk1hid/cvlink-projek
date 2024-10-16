<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemasanganTable extends Migration
{
    public function up()
    {
        // Menambahkan field untuk tabel pemasangan
        $this->forge->addField([
            'id_pemasangan'     => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kontrak'        => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'tanggal_mulai'     => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'tanggal_selesai'   => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'status_pemasangan'  => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'in_progress', 'completed', 'cancelled'],
                'default'    => 'pending',
            ],
            'id_user'           => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'catatan_pemasangan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);

        // Menambahkan Primary Key
        $this->forge->addKey('id_pemasangan', true);

        // Membuat tabel
        $this->forge->createTable('pemasangan');

        // Menambahkan Foreign Key
        $this->forge->addForeignKey('id_kontrak', 'kontrak', 'id_kontrak', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Menghapus tabel jika migrasi dibatalkan
        $this->forge->dropTable('pemasangan');
    }
}
