<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ArchivosCompartidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'archivo_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'usershare_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'usuarios', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('archivo_id', 'archivos', 'archivo_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usershare_id', 'usuarios', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('archcompartidas');
    }

    public function down()
    {
        $this->forge->dropTable('archcompartidas');
    }
}