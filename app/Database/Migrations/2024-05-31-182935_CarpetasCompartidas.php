<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CarpetasCompartidas extends Migration
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
            'carpeta_id' => [
                'type'       => 'INT',
                'constraint' => 5,
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
        $this->forge->addForeignKey('carpeta_id', 'carpetas', 'carpeta_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usershare_id', 'usuarios', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('carpcompartidas');
    }

    public function down()
    {
        $this->forge->dropTable('carpcompartidas');
    }
}
