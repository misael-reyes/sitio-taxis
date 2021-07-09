<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\Cab;
use Illuminate\Support\Facades\DB;

/**
 * DriverController
 */
class DriverController extends Controller {
        
    /**
     * función que recupera los datos de la tabla drivers para despues pasarselos
     * a la vista index, donde se encuentra la tabla con todos lo registros
     *
     * @return void
     */
    public function index(){
        $datos['choferes'] = Driver::all();
        return view('admin.chofer.index', $datos);
    }
    
    /**
     * función que retorna la vista create, que como sabemos, es la vista para crear
     * un nuvo registro
     *
     * @return void
     */
    public function create(){
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->leftJoin('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->whereNull('drivers.cab_id')
            ->get();

        return view('admin.chofer.create', compact('taxis'));
    }
    
    /**
     * función para guardar los datos de un nuevo registro chofer
     *
     * @param  mixed $request solicitud para registrar datos
     * @return void
     */
    public function store(Request $request){
        $datosChofer = request()->except('_token');
        try {
            Driver::insert($datosChofer);
            return redirect('chofer')->with('mensaje', 'Chofer agregado con éxito');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('chofer/create')->with('mensaje', 'Número telefónico duplicado, inserte otro');
        }
    }

    /**
     * función que recupera los datos del registro taxi seleccionado y los retorna en el 
     * formulario para que puedan ser editados
     *
     * @param  mixed $id clave del registro a editar
     * @return void
     */
    public function edit($id){        
        /** @var \Illuminate\Support\Facades\DB $taxis  
         * recuperamos aquellos taxis que aun no tengan asignado un chofer
        */
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->leftJoin('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->whereNull('drivers.cab_id')
            ->get();

        $chofer = Driver::findOrFail($id);
        return view('admin.chofer.edit', compact('chofer'), compact('taxis'));
    }
    
    /**
     * fución que actualiza los datos de un registro chofer
     *
     * @param  mixed $request solicitud de actualización
     * @param  mixed $id clave del registro a actualizar
     * @return void
     */
    public function update(Request $request, $id){
        $datosChofer = request()->except(['_token', '_method']);
        Driver::where('id', '=', $id)->update($datosChofer); //actualizamos en la BD
        return redirect('chofer')->with('mensaje', 'Chofer modificado');
    }
    
    /**
     * función para eliminar un registro de la base de datos
     *
     * @param  mixed $id clave del registro a eliminar
     * @return void
     */
    public function destroy($id){
        Driver::destroy($id);
        return redirect('chofer')->with('mensaje', 'Chofer eliminado');
    }
}
