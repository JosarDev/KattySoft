<?php

namespace App\Models;

use CodeIgniter\Model;

class Carpeta extends Model
{
    protected $table            = 'carpetas';
    protected $primaryKey       = 'carpeta_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'user_id', 'carpetapadre_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
