<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kontrak' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'harga' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);

        $this->forge->addPrimaryKey('id_invoice');
        
        // Menambahkan foreign key untuk id_kontrak
        $this->forge->addForeignKey('id_kontrak', 'kontrak', 'id_kontrak', 'CASCADE', 'CASCADE');

        $this->forge->createTable('invoice');
    }

    public function down()
    {
        // Menghapus tabel invoice
        $this->forge->dropTable('invoice');
    }
}
