<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\Usuario;

class AdminController extends BaseController
{
    protected $session, $usuarioModel, $archivoModel, $carpetaModel;
    public function __construct()
    {
        $this->session = session();
        $this->usuarioModel = new Usuario();
        $this->archivoModel = new Archivo();
        $this->carpetaModel = new Carpeta();
    }   
    public function index()
    {
        // Roles que tienen acceso a la vista de Admin
        $rolesAdmin = [1, 3]; // 1 = Admin, 3 = Servicios

        if (in_array($this->session->rol, $rolesAdmin)) {
            $data = [
                'usuarios' => $this->usuarioModel->countAllResults(),
                'carpetas' => $this->carpetaModel->where('user_id', $this->session->user_id)->countAllResults(),
                'archivos' => $this->archivoModel->where('user_id', $this->session->user_id)->countAllResults(),
            ];
            return view('admin/home', $data);
        }
        return view('admin/invitado');
    }

    public function usuario()
    {
        $data = $this->usuarioModel->select("
        SUM(IF(MONTH(created_at) = 1, 1, 0)) AS ene,
        SUM(IF(MONTH(created_at) = 2, 1, 0)) AS feb,
        SUM(IF(MONTH(created_at) = 3, 1, 0)) AS mar,
        SUM(IF(MONTH(created_at) = 4, 1, 0)) AS abr,
        SUM(IF(MONTH(created_at) = 5, 1, 0)) AS may,
        SUM(IF(MONTH(created_at) = 6, 1, 0)) AS jun,
        SUM(IF(MONTH(created_at) = 7, 1, 0)) AS jul,
        SUM(IF(MONTH(created_at) = 8, 1, 0)) AS ago,
        SUM(IF(MONTH(created_at) = 9, 1, 0)) AS sep,
        SUM(IF(MONTH(created_at) = 10, 1, 0)) AS oct,
        SUM(IF(MONTH(created_at) = 11, 1, 0)) AS nov,
        SUM(IF(MONTH(created_at) = 12, 1, 0)) AS dic")->first();
        return $this->response->setJSON($data);
    }

    public function newusuario()
    {
        $data = $this->usuarioModel->select('usuario, nombre, apellido, correo')->orderBy('user_id', 'asc')
            ->limit(3)->get()->getResultArray();
        return $this->response->setJSON($data);
    }

    public function newcarpeta()
    {
        $data = $this->carpetaModel->select('nombre')->orderBy('carpeta_id', 'asc')
            ->limit(3)->get()->getResultArray();
        return $this->response->setJSON($data);
    }

    public function newarchivo()
    {
        $data = $this->archivoModel->select('nombre')->orderBy('archivo_id', 'asc')
            ->limit(3)->get()->getResultArray();
        return $this->response->setJSON($data);
    }
}