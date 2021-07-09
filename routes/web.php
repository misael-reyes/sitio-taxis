<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CabController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ViajeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//accedemos mediante el uso de clases
Route::resource('taxi', CabController::class)->middleware('auth');
Route::resource('chofer', DriverController::class)->middleware('auth');
Route::resource('corrida', CorridaController::class)->middleware('auth');




Auth::routes(['reset'=>false]);


/**
 * dentro de este grupo, las rutas que estan se les asigna la autenticación
 */
Route::group(['middleware' => 'auth'], function(){
    //Route::get('/home', [CabController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //mostramos las corridas
    Route::get('reservacion', [ReservationController::class, 'mostrarCorridas'])->name('reservacion.corridas');
    //mostramos la vista para elegir los asientos
    Route::get('reservacion/{corrida}/asientos', [ReservationController::class, 'reservarAsiento'])->name('reservacion.asientos');
    //se hace la reservación y se generan los boletos
    Route::any('reservacion/{corrida}/boletos', [ReservationController::class, 'generarBoletos'])->name('reservacion.boletos');
    //realizar las cancelaciones
    Route::any('reservacion/{corrida}/cancelar', [ReservationController::class, 'cancelarReservacion'])->name('reservacion.cancelar');

    Route::any('reservacion/{corrida}/cancelacion', [ReservationController::class, 'cancelar'])->name('reservacion.cancelacion');

    Route::post('reservacion/{corrida}/buscar', [ReservationController::class, 'buscarCliente'])->name('reservacion.buscar');

    //empezamos con las rutas para los viajes especiales
    Route::get('viaje', [ViajeController::class, 'index'])->name('viaje.index');
    Route::get('viaje/create', [ViajeController::class, 'create'])->name('viaje.create');
    Route::post('viaje', [ViajeController::class, 'store'])->name('viaje.store');
    Route::get('viaje/boleto', [ViajeController::class, 'generarBoleto'])->name('viaje.boleto');

    //rutas para el módulo de paquetería
    Route::get('envio', [EnvioController::class, 'index'])->name('envio.index');
    Route::post('envio/buscar', [EnvioController::class, 'buscarEnvios'])->name('envio.buscar');
    Route::get('envio/create', [EnvioController::class, 'create'])->name('envio.create');
    Route::post('envio', [EnvioController::class, 'store'])->name('envio.store');

    //rutas para la sección de reportes
    Route::get('reporte', [ReporteController::class, 'index'])->name('reporte.index');
    Route::get('reporte/reservaciones', [ReporteController::class, 'pdfReservaciones'])->name('reporte.reservaciones');
    Route::get('reporte/detallesReservaciones', [ReporteController::class, 'pdfDetallesReservaciones'])->name('reporte.detallesReservaciones');
    Route::get('reporte/envios', [ReporteController::class, 'pdfEnvios'])->name('reporte.envios');
    Route::get('reporte/viajes', [ReporteController::class, 'pdfViajes'])->name('reporte.viajes');
    Route::get('reporte/taxis', [ReporteController::class, 'pdfTaxis'])->name('reporte.taxis');
    Route::get('reporte/corridas', [ReporteController::class, 'pdfCorridas'])->name('reporte.corridas');
    Route::get('reporte/choferes', [ReporteController::class, 'pdfChoferes'])->name('reporte.choferes');
    Route::get('reporte/usuarios', [ReporteController::class, 'pdfUsuarios'])->name('reporte.usuarios');
});
