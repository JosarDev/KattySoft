<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'clave' => [
                'type'       => 'VARCHAR',
                'constraint' => '200'
            ],
            'rol' => [
                'type'       => 'INT',
                'constraint' => 10
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
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
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}