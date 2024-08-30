<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Archivos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'archivo_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'tipo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'tamano' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'carpeta_id' => [
                'type'       => 'INT',
                'constraint' => 5
            ],
            'user_id' => [
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
        $this->forge->addKey('archivo_id', true);
        $this->forge->addForeignKey('carpeta_id', 'carpetas', 'carpeta_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'usuarios', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('archivos');
    }

    public function down()
    {
        $this->forge->dropTable('archivos');
    }
}
