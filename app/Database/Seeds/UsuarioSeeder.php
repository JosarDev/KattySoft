<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'correo' => 'superAdmin@gmail.com',
            'usuario'    => 'Super Admin',
            'nombre'    => 'Administrador del',
            'apellido'    => 'Sistema',
            'clave'    => password_hash('admin', PASSWORD_DEFAULT)
        ];
        // Using Query Builder
        $this->db->table('usuarios')->insert($data);
    }
}