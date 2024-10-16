<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilSurveiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hasil_survei' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'         => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'Tanggal_survei'  => [
                'type'       => 'DATETIME',
            ],
            'Jenis_instalasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kebutuhan_material' => [
                'type'       => 'TEXT',
            ],
            'estimasi_waktu'  => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'catatan_hasil_survei' => [
                'type'       => 'TEXT',
            ],
        ]);

        // Tambahkan Primary Key
        $this->forge->addKey('id_hasil_survei', true);

        // Buat tabel
        $this->forge->createTable('hasil_survei');

        // Tambahkan Foreign Key setelah tabel dibuat
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Hapus tabel jika migrasi dibatalkan
        $this->forge->dropTable('hasil_survei');
    }
}
