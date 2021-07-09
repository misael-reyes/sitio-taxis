<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Envio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Barryvdh\DomPDF\Facade as PDF;

class EnvioController extends Controller
{
    /**
     * Se muestra la tabla de los envios realizados.
     *
     * @return vista de los envíos
     */
    public function index(){
        $envios = array();
        return view('admin.envio.index', compact('envios'));
    }

    /**
     * muestra el formulario para registrar un nuevo envío
     *
     * @return vista de registro de envios
     */
    public function create(){
        //obtenemos la hora del sistema para usarla en la consulta
        $hora = $this->hora();
        //obtenemos las corridas de que aun no han pasado
        //$corridas = Corrida::all();
        $corridas = DB::table('corridas')->where('hora_salida', '>=', $hora)->get();
        return view('admin.envio.create', compact('corridas'));
    }

    /**
     * Insertamos en la base de datos los datos que nos dio el usuario
     *
     * @param   $request datos del formulario
     * @return vista del formulario
     */
    public function store(Request $request){
        $hoy = $this->fecha();
        //recuperamos los datos que nos dio el usuario
        $datos = request()->except('_token');
        $datos["fecha_envio"] = $hoy;
        //insertamos los datos en la base de datos
        Envio::insert($datos);
        return view('admin.envio.boleto', compact('datos'));
    }
    
    /**
     * busca en la base de datos los envíos realizados en la fecha dada
     *
     * @return /vista donde se muestran los envíos
     */
    public function buscarEnvios(){
        //obtenemos la fecha que el usuario inserto
        $fecha_a_buscar = request()->except('_token');
        //buscamos en la base de datos
        $envios = Envio::where('fecha_envio', '=', $fecha_a_buscar)->get();
        $tamano = count($envios);
        //retornamos los datos encontrados
        if ($tamano == 0) {
            return redirect('/envio')->with('mensaje', 'No hay envios en esta fecha');
        } else {
            return view('admin.envio.index', compact('envios'));
        }
    }

    /**
     * consultamos la fecha del sistema
     *
     * @return /fecha actual del sistema
     */
    public function fecha(){
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];
        return $fechaHoy;
    }
    
    /**
     * consultamos la hora actual del sistema
     *
     * @return /hora del sistema
     */
    public function hora(){
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $horaHoy = $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        return $horaHoy;
    }
}
