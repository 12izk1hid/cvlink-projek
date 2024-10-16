<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'   => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama'      => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'username'  => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true, // Menambahkan unique constraint untuk username
            ],
            'password'  => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat'    => [
                'type' => 'TEXT',
            ],
            'email'     => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true, // Menambahkan unique constraint untuk email
            ],
            'no_hp'     => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'role'      => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'surveyor', 'klien', 'teknisi'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id_user', true); // Menjadikan id_user sebagai primary key
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
