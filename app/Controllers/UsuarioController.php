<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class UsuarioController extends BaseController
{
    protected $usuarioModel, $reglas, $session;
    public function __construct()
    {
        $this->usuarioModel = new Usuario();
        $this->session = session();
    }

    public function index()
    {
        return view('usuarios/index');
    }

    public function show()
    {
        $data = $this->usuarioModel->orderBy('created_at', 'asc')->findAll();
        $item = 1;
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['item'] = $item;
            $item++;
        }
        return $this->response->setJSON($data);
    }

    public function new()
    {
        return view('usuarios/nuevo');
    }

    public function create()
    {
        $this->reglas = [
            'usuario' => [
                'rules' => "required|is_unique[usuarios.usuario]"
            ],
            'correo' => [
                'rules' => "required|valid_email|is_unique[usuarios.correo]"
            ],
            'nombre' => [
                'rules' => 'required'
            ],
            'apellido' => [
                'rules' => 'required'
            ],
            'rol' => [
                'rules' => 'required'
            ],
            'clave' => [
                'rules' => 'required|max_length[255]|min_length[6]'
            ],
            'confirmar' => [
                'rules' => 'required|max_length[255]|matches[clave]'
            ]
        ];

        if ($this->request->getMethod() == 'POST' && $this->validate($this->reglas)) {
            $data = $this->usuarioModel->insert([
                'correo' => $this->request->getPost('correo'),
                'usuario' => $this->request->getPost('usuario'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'rol' => $this->request->getPost('rol'),
                'clave' => password_hash($this->request->getVar('clave'), PASSWORD_DEFAULT)
            ]);
            if ($data) {
                return redirect()->to('/usuarios')->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'USUARIO REGISTRADO'
                ]);
            }
            return redirect()->to('/usuarios')->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL REGISTRAR'
            ]);
        } else {
            $data['validator'] = $this->validator;
            return view('usuarios/nuevo', $data);
        }
    }

    public function edit($id)
    {
        $data['usuario'] = $this->usuarioModel->find($id);
        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $this->reglas = [
            'usuario' => [
                'rules' => "required|is_unique[usuarios.usuario,user_id,{$id}]"
            ],
            'correo' => [
                'rules' => "required|valid_email|is_unique[usuarios.correo,user_id,{$id}]"
            ],
            'nombre' => [
                'rules' => 'required'
            ],
            'apellido' => [
                'rules' => 'required'
            ],
            'rol' => [
                'rules' => 'required'
            ]
        ];

        if ($this->request->getMethod() == 'PUT' && $this->validate($this->reglas)) {
            $data = $this->usuarioModel->update($id, [
                'correo' => $this->request->getPost('correo'),
                'usuario' => $this->request->getPost('usuario'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'rol' => $this->request->getPost('rol')
            ]);
            if ($data) {
                return redirect()->to('/usuarios')->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'USUARIO MODIFICADO'
                ]);
            }
            return redirect()->to('/usuarios')->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL MODIFICAR'
            ]);
        } else {
            $data['validator'] = $this->validator;
            $data['usuario'] = $this->usuarioModel->find($id);
            return view('usuarios/edit', $data);
        }
    }

    public function delete($id) {
        if ($this->request->getMethod() == "DELETE"){
            $data = $this->usuarioModel->delete($id);
            if ($data) {
                return $this->response->setJSON([
                    'type' => 'success',
                    'msg' => 'USUARIO ELIMINADO'
                ]);
            }
            return $this->response->setJSON([
                'type' => 'error',
                'msg' => 'ERROR AL ELIMINAR'
            ]);
        }
    }
}
