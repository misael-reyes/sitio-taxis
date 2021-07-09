<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViajeController extends Controller
{
    /**
     * Se muestran los viajes especiales activos en la tabla
     *
     * @return /vista de los viajes
     */
    public function index(){
        /**
         * se deberán mostrar todos los viajes que esten activos, aquellos que venzan hoy, se deberán
         * de quitar de la tabla el día siguiente
         */
        $hoy = $this->fecha();
        $ayer = date("Y-m-d",strtotime($hoy."- 1 days")); 
        //viajes activos
        $viajes = Viaje::where('fecha_final','>=',$hoy)->get();
        //viajes que vencen hoy
        $viajesAvencer = Viaje::where('fecha_final', '=', $ayer)->get();
        if(count($viajesAvencer) != 0){
            foreach($viajesAvencer as $viaje){
                //liberamos el taxi que participo en el viaje
                DB::update('update cabs set rol = "local" where id = ?',[$viaje["cab_id"]]);
            }
        }
        return view('admin.viajes.index', compact('viajes'));
    }

    /**
     * Mostramos la vista del formulario para registrar un nuevo viaje
     *
     * @return /vista para crear un registro de viaje
     */
    public function create(){
        //recuperamos los taxis que esten de local
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->Join('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->where('cabs.rol', '=', 'local')
            ->get();
        //retornamos la vista pasandole los taxis disponibles para el viaje
        return view('admin.viajes.create', compact('taxis'));
    }

    /**
     * Ingresamos los datos que nos dió el usuario en la base de datos
     * despues generamos los boletos y los mostramos en su vista
     *
     * @param  \Illuminate\Http\Request  $request datos del usuario
     * @return /vista de los boletos
     */
    public function store(Request $request){
        //recupero los datos del usuario
        $datos = request()->except('_token');
        //guardamos en la base de datos
        Viaje::insert($datos);
        //actualizamos la tabla cabs para indicar que el taxi seleccionado esta en un viaje
        DB::update('update cabs set rol = "viaje especial" where id = ?',[$datos["cab_id"]]);
        //generamos los boletos y los mostramos
        return view('admin.viajes.boleto', compact('datos'));
    }

    /**
     * consultamos la fecha del sistema
     *
     * @return /fecha actual del sistema
     */
    public function fecha() {
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];
        return $fechaHoy;
    }
}
