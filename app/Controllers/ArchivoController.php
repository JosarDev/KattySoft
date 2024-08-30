<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Archcompartida;
use App\Models\Archivo;
use App\Models\Carpcompartida;
use App\Models\Carpeta;
use App\Models\Usuario;

class ArchivoController extends BaseController
{
    protected $archivoModel, $carpetaModel, $usuarioModel, $reglas, $session;
    public function __construct()
    {
        $this->archivoModel = new Archivo();
        $this->usuarioModel = new Usuario();
        $this->carpetaModel = new Carpeta();
        $this->session = session();
    }

    public function upload()
    {
        $archivos = $this->request->getFileMultiple('file');
        $destino = 'assets/uploads/';
        $res = 0;
        for ($i = 0; $i < count($archivos); $i++) {
            $archivo = $archivos[$i];
            $nombre = $archivo->getName();
            if ($archivo->move($destino, $nombre)) {
                $res = $this->archivoModel->insert(
                    [
                        'nombre' => $nombre,
                        'tipo' => $archivo->getClientMimeType(),
                        'tamano' => $archivo->getSize(),
                        'carpeta_id' => $this->request->getVar('carpeta_id'),
                        'user_id' => $this->session->user_id
                    ]
                );
            }
        }
        if ($res > 0) {
            return $this->response->setJSON([
                'type' => 'success',
                'msg' => 'ARCHIVO SUBIDO'
            ]);
        } else {
            return $this->response->setJSON([
                'type' => 'error',
                'msg' => 'ERROR AL SUBIR'
            ]);
        }
    }

    public function show($id)
    {
        $data['archivos'] = $this->archivoModel
            ->where('carpeta_id', $id)
            ->orderBy('created_at', 'asc')
            ->findAll();
        $item = 1;
        for ($i = 0; $i < count($data['archivos']); $i++) {
            $data['archivos'][$i]['item'] = $item;
            $item++;
        }
        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == "DELETE") {
            //RECUPERAR EL NOMBRE
            $archivo = $this->archivoModel->find($id);
            $data = $this->archivoModel->delete($id);
            if ($data) {
                //ELIMINAR DEL DISCO
                $destino = 'assets/uploads/' . $archivo['nombre'];
                if (file_exists($destino)) {
                    unlink($destino);
                }
                return $this->response->setJSON([
                    'type' => 'success',
                    'msg' => 'ARCHIVO ELIMINADO'
                ]);
            }
            return $this->response->setJSON([
                'type' => 'error',
                'msg' => 'ERROR AL ELIMINAR'
            ]);
        }
    }

    public function share($id)
    {
        $data['archivo'] = $this->archivoModel->find($id);
        return view('archivos/compartir', $data);
    }

    public function usuarios($archivo_id)
    {
        $compartida = new Archcompartida();
        $id_usuario = $this->session->user_id;
        $data = $this->usuarioModel->where('user_id != ' . $id_usuario)->orderBy('created_at', 'desc')->findAll();
        //usuarios selecionados
        $seleccionados = $compartida->where('archivo_id', $archivo_id)->findColumn('user_id');
        if (!isset($seleccionados) || !is_array($seleccionados)) {
            $seleccionados = [];
        }
        $item = 1;
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['existe'] = in_array($data[$i]['user_id'], $seleccionados);
            $data[$i]['item'] = $item;
            $item++;
        }
        return $this->response->setJSON($data);
    }

    public function compartir()
    {
        $valores = $this->request->getJSON(true);
        $compartida = new Archcompartida();
        $data = 0;
        //ELIMINAR ARCHIVOS ANTERIORES
        $compartida->where(['archivo_id' => $valores['archivo_id']])->delete();
        for ($i = 0; $i < count($valores['usuarios']); $i++) {
            $user = $valores['usuarios'][$i];
            $data = $compartida->insert([
                'user_id' => $user,
                'archivo_id' => $valores['archivo_id'],
                'usershare_id' => $this->session->user_id
            ]);
        }
        if ($data > 0) {
            $res = [
                'type' => 'success',
                'msg' => 'ARCHIVO COMPARTIDO'
            ];
        } else {
            $res = [
                'type' => 'success',
                'msg' => 'ERROR AL CAMPARTIR'
            ];
        }
        return $this->response->setJSON($res);
    }

    //BUSQUEDA
    public function busqueda()
    {
        $valor = $this->request->getVar('term');
        /* if ($this->session->rol == 1) {
            //BUSQUEDA DE ARCHIVOS
            $data['archivos'] = $this->archivoModel->like('nombre', $valor)
                ->where('user_id', $this->session->user_id)->findAll(10);
            //BUSQUEDA DE CARPETAS
            $data['carpetas'] = $this->carpetaModel->like('nombre', $valor)
                ->where('user_id', $this->session->user_id)->findAll(10);
        } else {
            $archcompartidoModel = new Archcompartida();
            $data = $archcompartidoModel->select('a.archivo_id, a.nombre')
                ->join('archivos AS a', 'archcompartidas.archivo_id = a.archivo_id')
                ->like('a.nombre', $valor)
                ->where('archcompartidas.user_id', $this->session->user_id)->findAll(10);
        } */
        //BUSQUEDA DE ARCHIVOS
        $data['archivos'] = $this->archivoModel->like('nombre', $valor)
            ->where('user_id', $this->session->user_id)->findAll(5);
        //BUSQUEDA DE CARPETAS
        $data['carpetas'] = $this->carpetaModel->like('nombre', $valor)
            ->where('user_id', $this->session->user_id)->findAll(5);
        $array = [];
        foreach ($data['archivos'] as $row) {
            $array[] = [
                'id' => $row['archivo_id'],
                'label' => $row['nombre'],
                'nombre' => $row['nombre'],
                'tipo' => 'archivo'
            ];
        }
        foreach ($data['carpetas'] as $row) {
            $array[] = [
                'id' => $row['carpeta_id'],
                'label' => $row['nombre'],
                'nombre' => $row['nombre'],
                'tipo' => 'carpeta'
            ];
        }
        return $this->response->setJSON($array);
    }
}