<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJasaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jasa'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_item'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'type'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'min_harga'   => [
                'type'       => 'varchar',
                'constraint' => 20,
            ],
            'max_harga'   => [
                'type'       => 'varchar',
                'constraint' => 20,
            ],
        ]);

        // Tambahkan Primary Key
        $this->forge->addKey('id_jasa', true);

        // Buat tabel
        $this->forge->createTable('jasa');
    }

    public function down()
    {
        // Hapus tabel jika migrasi dibatalkan
        $this->forge->dropTable('jasa');
    }
}
