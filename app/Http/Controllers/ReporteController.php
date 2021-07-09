<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use App\Models\Corrida;
use App\Models\Driver;
use App\Models\Envio;
use App\Models\Reservation;
use App\Models\Reservation_detail;
use App\Models\User;
use App\Models\Viaje;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\PDF;
use \Barryvdh\DomPDF\Facade as PDF;
//use PDF;

class ReporteController extends Controller
{
        
    /**
     * se muestra la tabla con los nombres de todas las tablas
     * de la base de datos
     *
     * @return /vista index de los reportes
     */
    public function index(){
        return view('admin.reporte.index');
    }
    
    /**
     * Se genera y se descarga el pdf de la tabla reservaciones
     *
     * @return /archivo pdf
     */
    public function pdfReservaciones(){
        $reservaciones = Reservation::all();
        $pdf = PDF::loadView('admin.reporte.reservacionespdf', compact('reservaciones'));
        return $pdf->download('reservaciones.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla detalle_reservacion
     *
     * @return /archivo pdf
     */
    public function pdfDetallesReservaciones(){
        $datos = Reservation_detail::all();
        $pdf = PDF::loadView('admin.reporte.detalle-rpdf', compact('datos'));
        return $pdf->download('detallesReservaciones.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla envios
     *
     * @return /archivo pdf
     */
    public function pdfEnvios(){
        $datos = Envio::all();
        return PDF::loadView('admin.reporte.enviospdf', compact('datos'))
        ->setPaper('a4', 'landscape')
        ->download('envios.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla viajes
     *
     * @return /archivo pdf
     */
    public function pdfViajes(){
        $datos = Viaje::all();
        return PDF::loadView('admin.reporte.viajespdf', compact('datos'))
        ->setPaper('a4', 'landscape')
        ->download('viajes.pdf');
    }
    
    /**
     * Se genera y se descarga el pdf de la tabla taxis
     *
     * @return /archivo pdf
     */
    public function pdfTaxis(){
        $datos = Cab::all();
        $pdf = PDF::loadView('admin.reporte.taxispdf', compact('datos'));
        return $pdf->download('taxis.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla corridas
     *
     * @return /archivo pdf
     */
    public function pdfCorridas(){
        $datos = Corrida::all();
        $pdf = PDF::loadView('admin.reporte.corridaspdf', compact('datos'));
        return $pdf->download('corridas.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla choferes
     *
     * @return /archivo pdf
     */
    public function pdfChoferes(){
        $datos = Driver::all();
        return PDF::loadView('admin.reporte.choferespdf', compact('datos'))
        ->setPaper('a4', 'landscape')
        ->download('choferes.pdf');
    }

    /**
     * Se genera y se descarga el pdf de la tabla usuarios
     *
     * @return /archivo pdf
     */
    public function pdfUsuarios(){
        $datos = User::all();
        return PDF::loadView('admin.reporte.usuariospdf', compact('datos'))
        ->setPaper('a4', 'landscape')
        ->download('usuarios.pdf');
    }
}