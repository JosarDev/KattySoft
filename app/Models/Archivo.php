<?php

namespace App\Models;

use CodeIgniter\Model;

class Archivo extends Model
{
    protected $table            = 'archivos';
    protected $primaryKey       = 'archivo_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'tipo', 'tamano', 'carpeta_id', 'user_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
