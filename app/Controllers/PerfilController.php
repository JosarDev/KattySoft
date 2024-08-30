<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class PerfilController extends BaseController
{
    protected $usuarioModel, $reglas, $session;
    public function __construct()
    {
        $this->usuarioModel = new Usuario();
        $this->session = session();
    }

    public function index()
    {
        $data['usuario'] = $this->usuarioModel->find($this->session->user_id);
        return view('usuarios/perfil', $data);
    }

    public function updatePerfil()
    {
        $id = $this->session->user_id;
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
            'avatar' => [
                'rules' => 'permit_empty|is_image[avatar]|max_size[avatar,2048]|ext_in[avatar,png,jpg,jpeg]'
            ]
        ];

        if ($this->request->getMethod() == 'PUT' && $this->validate($this->reglas)) {
            //COMPROBAR AVATAR
            $avatar = $this->request->getFile('avatar');
            if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
                $destino = 'assets/images/avatars/';
                $nombreImage = date('YmdHis') . '.png';
                $array['avatar'] = $nombreImage;
                $avatar->move($destino, $nombreImage);
                $this->session->set([
                    'avatar' => $nombreImage
                ]);
            } else {
                $array['avatar'] = $this->session->avatar;
            }
            $array['correo'] = $this->request->getPost('correo');
            $array['usuario'] = $this->request->getPost('usuario');
            $array['nombre'] = $this->request->getPost('nombre');
            $array['apellido'] = $this->request->getPost('apellido');
            $data = $this->usuarioModel->update($id, $array);
            if ($data) {
                return redirect()->to('/perfil')->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'PERFIL MODIFICADO'
                ]);
            }
            return redirect()->to('/perfil')->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL MODIFICAR'
            ]);
        } else {
            $data['validator'] = $this->validator;
            $data['usuario'] = $this->usuarioModel->find($id);
            return view('usuarios/perfil', $data);
        }
    }

    public function updatePassword(){
        $this->reglas = [
            'actual' => [
                'rules' => 'required'
            ],
            'nueva' => [
                'rules' => 'required|max_length[255]|min_length[6]'
            ],
            'confirmar' => [
                'rules' => 'required|max_length[255]|matches[nueva]'
            ]
        ];

        if ($this->request->getMethod() == 'PUT' && $this->validate($this->reglas)) {
            $actual = $this->request->getVar('actual');
            $nueva = $this->request->getVar('nueva');
            $consulta = $this->usuarioModel->find($this->session->user_id);
            if(password_verify($actual, $consulta['clave'])){
                $data = $this->usuarioModel->update($this->session->user_id, [
                    'clave' => password_hash($nueva, PASSWORD_DEFAULT)
                ]);
                if ($data) {
                    return redirect()->to('/perfil')->with('respuesta', [
                        'type' => 'success',
                        'msg' => 'CONTRASEÑA MODIFICADO'
                    ]);
                }
                return redirect()->to('/perfil')->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL MODIFICAR'
                ]);
            }else{
                return redirect()->to('/perfil')->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'CONTRASEÑA ACTUAL INCORRECTA'
                ]);
            }
            
        } else {
            $data['validator'] = $this->validator;
            $data['usuario'] = $this->usuarioModel->find($this->session->user_id);
            return view('usuarios/perfil', $data);
        }
    }
}