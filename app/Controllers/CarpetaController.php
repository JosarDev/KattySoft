<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Archcompartida;
use App\Models\Archivo;
use App\Models\Carpcompartida;
use App\Models\Carpeta;
use App\Models\Usuario;

class CarpetaController extends BaseController
{
    protected $carpetaModel, $usuarioModel, $archivoModel, $reglas, $session;
    public function __construct()
    {
        $this->carpetaModel = new Carpeta();
        $this->usuarioModel = new Usuario();
        $this->archivoModel = new Archivo();
        $this->session = session();
    }

    public function index()
    {
        $carpetas = $this->carpetaModel
            ->where([
                'user_id' => $this->session->user_id,
                'carpetapadre_id' => null
            ])->orderBy('carpeta_id', 'asc')
            ->paginate(12);

        $cantidadArchivos = $this->archivoModel->select('carpeta_id, COUNT(*) as total')
            ->where('user_id', $this->session->user_id)
            ->groupBy('carpeta_id')->get()->getResultArray();

        $archivosCount = [];
        foreach ($cantidadArchivos as $count) {
            $archivosCount[$count['carpeta_id']] = $count['total'];
        }

        foreach ($carpetas as &$carpeta) {
            $carpeta['total'] = $archivosCount[$carpeta['carpeta_id']] ?? 0;
        }
        $data = [
            'nuevo' => true,
            'regresar' => false,
            'carpetas' => $carpetas,
            'pager' => $this->carpetaModel->pager,
        ];
        return view('carpetas/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'POST') {
            $id_carpeta = $this->request->getPost('id_carpeta');
            $id_subcarpeta = $this->request->getPost('id_subcarpeta');
            $nombre = $this->request->getPost('nombre');
            if (empty($nombre)) {
                $res = ['type' => 'warning', 'msg' => 'El nombre es requerido'];
            } else {
                //VALIDAR PARA CREAR O EDITAR
                $carpetapadre_id = (empty($id_subcarpeta)) ? null : $id_subcarpeta;
                if (empty($id_carpeta)) {
                    $data = $this->carpetaModel->insert([
                        'nombre' => $nombre,
                        'user_id' => $this->session->user_id,
                        'carpetapadre_id' => $carpetapadre_id
                    ]);
                    if ($data > 0) {
                        $res = ['type' => 'success', 'msg' => 'CARPETA CREADA'];
                    } else {
                        $res = ['type' => 'error', 'msg' => 'ERROR AL CREAR CARPETA'];
                    }
                } else {
                    $data = $this->carpetaModel->update($id_carpeta, [
                        'nombre' => $nombre
                    ]);
                    if ($data > 0) {
                        $res = ['type' => 'success', 'msg' => 'CARPETA MODIFICADA'];
                    } else {
                        $res = ['type' => 'error', 'msg' => 'ERROR AL MODIFICAR CARPETA'];
                    }
                }
            }
        } else {
            $res = ['type' => 'error', 'msg' => 'ERROR DESCONOCIDO'];
        }
        return $this->response->setJSON($res);
    }

    public function edit($id)
    {
        $data['carpeta'] = $this->carpetaModel->find($id);
        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == "DELETE") {
            $data = $this->carpetaModel->delete($id);
            if ($data) {
                return $this->response->setJSON([
                    'type' => 'success',
                    'msg' => 'CARPETA ELIMINADO'
                ]);
            }
            return $this->response->setJSON([
                'type' => 'error',
                'msg' => 'ERROR AL ELIMINAR'
            ]);
        }
    }

    public function show($id)
    {
        $carpetas = $this->carpetaModel
            ->where('carpetapadre_id', $id)->orderBy('carpeta_id', 'asc')
            ->paginate(12);

        $cantidadArchivos = $this->archivoModel->select('carpeta_id, COUNT(*) as total')
            ->where('user_id', $this->session->user_id)
            ->groupBy('carpeta_id')->get()->getResultArray();

        $archivosCount = [];
        foreach ($cantidadArchivos as $count) {
            $archivosCount[$count['carpeta_id']] = $count['total'];
        }

        foreach ($carpetas as &$carpeta) {
            $carpeta['total'] = $archivosCount[$carpeta['carpeta_id']] ?? 0;
        }

        $data = [
            'nuevo' => false,
            'regresar' => true,
            'carpeta' => $this->carpetaModel->find($id),
            'carpetas' => $carpetas,
            'pager' => $this->carpetaModel->pager,
        ];
        return view('carpetas/show', $data);
    }

    //COMPARTIR CARPETAS
    public function share($id)
    {
        $data['carpeta'] = $this->carpetaModel->find($id);
        return view('carpetas/compartir', $data);
    }

    public function usuarios($carpeta_id)
    {
        $compartida = new Carpcompartida();
        $id_usuario = $this->session->user_id;
        $data = $this->usuarioModel->where('user_id != ' . $id_usuario)->orderBy('created_at', 'desc')->findAll();
        //usuarios selecionados
        $seleccionados = $compartida->where('carpeta_id', $carpeta_id)->findColumn('user_id');
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
        $compartida = new Carpcompartida();
        $data = 0;
        //ELIMINAR CARPETA COMPARTIDA ANTERIORES
        $compartida->where(['carpeta_id' => $valores['carpeta_id']])->delete();
        for ($i = 0; $i < count($valores['usuarios']); $i++) {
            $user = $valores['usuarios'][$i];
            $data = $compartida->insert([
                'user_id' => $user,
                'carpeta_id' => $valores['carpeta_id'],
                'usershare_id' => $this->session->user_id
            ]);
        }
        if ($data > 0) {
            $res = [
                'type' => 'success',
                'msg' => 'CARPETA COMPARTIDA'
            ];
        } else {
            $res = [
                'type' => 'success',
                'msg' => 'ERROR AL CAMPARTIR'
            ];
        }
        return $this->response->setJSON($res);
    }

    public function busqueda()
    {
        $valor = $this->request->getVar('term');
        $carpcompartidoModel = new Carpcompartida();
        $carpetas = $carpcompartidoModel->select('c.carpeta_id, c.nombre')
            ->join('carpetas AS c', 'carpcompartidas.carpeta_id = c.carpeta_id')
            ->like('c.nombre', $valor)
            ->where('carpcompartidas.user_id', $this->session->user_id)->findAll(5);

        $resultado = [];
        foreach ($carpetas as $row) {
            $resultado[] = [
                'id' => $row['carpeta_id'],
                'label' => $row['nombre'],
                'nombre' => $row['nombre'],
                'tipo' => 'carpeta'
            ];
        }

        $carpetasComps = $carpcompartidoModel->select('carpeta_id')
        ->where('user_id', $this->session->user_id)->findAll();
        $carpetasIds = [];
        foreach ($carpetasComps as $row) {
            $carpetasIds[] = $row['carpeta_id'];
        }
        //BUSCAR LOS ARCHIVOS
        $archivos = $this->archivoModel->like('nombre', $valor)
            ->whereIn('carpeta_id', $carpetasIds)->findAll(5);

        foreach ($archivos as $row) {
            $resultado[] = [
                'id' => $row['archivo_id'],
                'label' => $row['nombre'],
                'nombre' => $row['nombre'],
                'tipo' => 'archivo'
            ];
        }
        return $this->response->setJSON($resultado);
    }
}