<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CabController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CorridaController;
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
/*
ESTO GENERO LA AUTENTICACION
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/
Auth::routes(['reset'=>false]);

//Route::get('/home', [CabController::class, 'index'])->name('home');

//esto va a pasar cuando el usuario se loggea
Route::group(['middleware' => 'auth'], function(){
    //Route::get('/home', [CabController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

/* esto tendre que hacer

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
});*/
 
