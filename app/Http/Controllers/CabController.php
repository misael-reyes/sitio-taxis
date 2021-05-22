<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CabController extends Controller
{
    public function index()
    {
        // vista principal de taxis
        $datos['taxis'] = Cab::paginate(30);
        return view('admin.taxi.index',$datos);
    }

    public function create()
    {
        return view('admin.taxi.create');
    }

    public function store(Request $request)
    {
        //campos a validar
        /*
        $campos=[
            'placa'=>'required|string|max:30',
            'marca'=>'required|string|max:40',
            'modelo'=>'required|string|max:40',
            'year'=>'required|integer',
            'rol'=>'required|string|max:30',
        ];
        //:attribute es un comodin para todos los campos que esten vacio
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'marca.required'=>'La marca es requerida',
            'placa.required'=>'La placa es requerida'
        ];
        $this->validate($request, $campos, $mensaje);
        */

        $datosTaxi = request()->except('_token');
        Try{
            Cab::insert($datosTaxi);
            return redirect('taxi')->with('mensaje','Taxi agregado con éxito');
        } catch(\Illuminate\Database\QueryException $e){
            return redirect('taxi/create')->with('mensaje','No puede haber una placa duplicada');
        }  
    }

    public function show(Cab $cab)
    {
        //
    }

    public function edit($id)
    {
        $taxi=Cab::findOrFail($id);
        return view('admin.taxi.edit', compact('taxi'));
    }

    public function update(Request $request, $id)
    {
        //campos a validar
        /*
        $campos=[
            'placa'=>'required|string|max:30',
            'marca'=>'required|string|max:40',
            'modelo'=>'required|string|max:40',
            'year'=>'required|integer',
            'rol'=>'required|string|max:30',
        ];
        //:attribute es un comodin para todos los campos que esten vacio
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'marca.required'=>'La marca es requerida',
            'placa.required'=>'La placa es requerida'
        ];
        $this->validate($request, $campos, $mensaje);
        */
        $datosTaxi = request()->except(['_token','_method']);
        Cab::where('id','=',$id)->update($datosTaxi); //actualizamos en la BD
        return redirect('taxi')->with('mensaje', 'Taxi modificado');
    }

    public function destroy($id)
    {
        Cab::destroy($id);
        return redirect('taxi')->with('mensaje', 'Taxi eliminado');
    }
}
