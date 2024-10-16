<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontrakTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kontrak' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_hasil_survei' => [
                'type'           => 'INT',
                'unsigned'       => true,
                
            ],
            'id_user'   => [
                'type'           => 'INT',
                'constraint'     => 5,
               
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
                'default'        => null,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
                'default'        => null,
            ],
            'harga' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
        ]);

        $this->forge->addKey('id_kontrak', true);
        
        // Definisi foreign key
        $this->forge->addForeignKey('id_hasil_survei', 'hasil_survei', 'id_hasil_survei', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');

        $this->forge->createTable('kontrak');
    }

    public function down()
    {
        $this->forge->dropForeignKey('kontrak', 'kontrak_id_hasil_survei_foreign');
        $this->forge->dropForeignKey('kontrak', 'kontrak_id_user_foreign');
        $this->forge->dropTable('kontrak');
    }
}
