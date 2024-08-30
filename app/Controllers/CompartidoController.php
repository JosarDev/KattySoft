<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Archcompartida;
use App\Models\Archivo;
use App\Models\Carpcompartida;
use App\Models\Carpeta;

class CompartidoController extends BaseController
{
    protected $carpetaModel, $archivoModel, $archcompartidaModel, $session;
    public function __construct()
    {
        $this->carpetaModel = new Carpcompartida();
        $this->archivoModel = new Archivo();
        $this->archcompartidaModel = new Archcompartida();
        $this->session = session();
    }
    
    public function carpeta()
    {
        $carpetas = $this->carpetaModel->select('carpcompartidas.*, c.nombre')
        ->join('carpetas AS c', 'carpcompartidas.carpeta_id = c.carpeta_id')
        ->where('carpcompartidas.user_id', $this->session->user_id)
        ->orderBy('carpcompartidas.id', 'asc')
        ->paginate(12);

        $cantidadArchivos = $this->archivoModel->select('carpeta_id, COUNT(*) as total')
        ->groupBy('carpeta_id')->get()->getResultArray();

        $archivosCount = [];
        foreach ($cantidadArchivos as $count) {
            $archivosCount[$count['carpeta_id']] = $count['total'];
        }

        foreach ($carpetas as &$carpeta) {
            $carpeta['total'] = $archivosCount[$carpeta['carpeta_id']] ?? 0;
        }
        
        $data = [
            'carpetas' => $carpetas,
            'pager' => $this->carpetaModel->pager,
        ];

        return view('compartidos/carpeta', $data);
    }

    public function detcarpeta($id) {
        $carpetaModel = new Carpeta();
        $data['carpeta'] = $carpetaModel->find($id);
        return view('compartidos/carpeta-share', $data);
    }

    //archivos compartidos
    public function archivo()
    {
        return view('compartidos/archivo');
    }

    public function detarchivo() {
        $data['archivos'] = $this->archcompartidaModel->select('archcompartidas.*, a.nombre, a.tipo')
        ->join('archivos AS a', 'archcompartidas.archivo_id = a.archivo_id')
        ->where('archcompartidas.user_id', $this->session->user_id)
        ->get()->getResultArray();
        $item = 1;
        for ($i=0; $i < count($data['archivos']); $i++) { 
            $data['archivos'][$i]['item'] = $item;
            $item++;
        }
        return $this->response->setJSON($data);
    }
}