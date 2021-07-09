<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Cab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorridaController extends Controller{
    /**
     * función que recupera los datos de la tabla cabs para despues pasarselos
     * a la vista index, donde se encuentra la tabla con todos lo registros
     *
     * @return void
     */
    public function index(){
        //$datos['corridas']= Corrida::paginate(20);
        //return view('admin.corrida.index', $datos);
        //$corridas = DB::table('corridas')->get();
        $corridas = Corrida::all();
        return view('admin.corrida.index', compact('corridas'));
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
            ->join('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->where('cabs.rol','=','ruta')
            ->get();

        return view('admin.corrida.create', compact('taxis'));
    }
    
    /**
     * función para guardar los datos de un nuevo registro corrida
     *
     * @param  mixed $request solicitud para registrar
     * @return void
     */
    public function store(Request $request){
        $datosCorrida = request()->except('_token');
        Corrida::insert($datosCorrida);
        return redirect('corrida')->with('mensaje','Corrida agregada con éxito');
    }

    /**
     * función que recupera los datos del registro corrida seleccionado y los retorna en el 
     * formulario para que puedan ser editados
     *
     * @param  mixed $id clave del registro a editar
     * @return void
     */
    public function edit($id){        
        /** @var \Illuminate\Support\Facades\DB $taxis 
         * recuperamos aquellos taxis que ya tienen asignado un chofer y que tengan el servicio
         * de ruta
        */
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->join('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->where('cabs.rol','=','ruta')
            ->get();
        $corrida = Corrida::findOrFail($id);
        return view('admin.corrida.edit', compact('corrida'), compact('taxis'));
    }
    
    /**
     * fución que actualiza los datos de un registro corrida
     *
     * @param  mixed $request solicitud de actualizacion
     * @param  mixed $id clave del registro a actualizar
     * @return void
     */
    public function update(Request $request, $id){
        $datosCorrida = request()->except(['_token','_method']);
        Corrida::where('id','=',$id)->update($datosCorrida); //actualizamos en la BD
        return redirect('corrida')->with('mensaje', 'Corrida modificada');
    }
    
    /**
     * función para eliminar un registro de la base de datos
     *
     * @param  mixed $id clave del registro a eliminar
     * @return void
     */
    public function destroy($id){
        Corrida::destroy($id);
        return redirect('corrida')->with('mensaje','Corrida eliminada');
    }
}
