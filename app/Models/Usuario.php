<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['correo', 'usuario', 'nombre', 'apellido', 'clave', 'rol', 'token', 'avatar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}