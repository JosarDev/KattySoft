<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Carpetas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'carpeta_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'carpetapadre_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null' => true
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
        $this->forge->addKey('carpeta_id', true);
        $this->forge->addForeignKey('user_id', 'usuarios', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('carpetapadre_id', 'carpetas', 'carpeta_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('carpetas');
    }

    public function down()
    {
        $this->forge->dropTable('carpetas');
    }
}
