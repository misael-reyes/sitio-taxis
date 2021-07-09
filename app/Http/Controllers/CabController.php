<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CabController extends Controller {  
    /**
     * index
     *
     * función que recupera los datos de la tabla cabs para despues pasarselos
     * a la vista index, donde se encuentra la tabla con todos lo registros
     * 
     * @return void
     */
    public function index(){
        $datos['taxis'] = Cab::all();
        return view('admin.taxi.index',$datos);
    }
    
    /**
     * create
     * 
     * función que retorna la vista create, que como sabemos, es la vista para crear
     * un nuvo registro
     *
     * @return void
     */
    public function create(){
        return view('admin.taxi.create');
    }
    
    /**
     * store
     * 
     * función para guardar los datos de un nuevo registro taxi
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request){        
        /** @var mixed $datosTaxi recuperamos los datos que enivio el usuario */
        $datosTaxi = request()->except('_token');
        Try{            
            /** @var mixed $datosTaxi insertamos en la base de datos */
            Cab::insert($datosTaxi);
            return redirect('taxi')->with('mensaje','Taxi agregado con éxito');
        } catch(\Illuminate\Database\QueryException $e){
            return redirect('taxi/create')->with('mensaje','No puede haber una placa duplicada');
        }  
    }

    public function show(Cab $cab){
        //
    }
    
    /**
     * edit
     * 
     * función que recupera los datos del registro taxi seleccionado y los retorna en el 
     * formulario para que puedan ser editados
     *
     * @param  mixed $id clave del taxi seleccionado
     * @return void vista edit, pero con los datos del registro seleccionado
     */
    public function edit($id){
        $taxi=Cab::findOrFail($id);
        return view('admin.taxi.edit', compact('taxi'));
    }
    
    /**
     * update
     * 
     * fución que actualiza los datos de un registro taxi
     *
     * @param  mixed $request solicitud para actualizar datos
     * @param  mixed $id clave del registro que se actualizará
     * @return void muestra la vista index con un mesaje de éxito
     */
    public function update(Request $request, $id){
        $datosTaxi = request()->except(['_token','_method']);        
        /** actualizamos la base de datos */
        Cab::where('id','=',$id)->update($datosTaxi);
        return redirect('taxi')->with('mensaje', 'Taxi modificado');
    }
    
    /**
     * destroy
     * 
     * función para eliminar un registro de la base de datos
     *
     * @param  mixed $id clave del registro a eliminar
     * @return void muestra la vista index con un mensaje de éxito
     */
    public function destroy($id){
        Cab::destroy($id);
        return redirect('taxi')->with('mensaje', 'Taxi eliminado');
    }
}