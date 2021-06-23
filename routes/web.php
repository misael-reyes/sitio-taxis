<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CabController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\ReservationController;
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
});
