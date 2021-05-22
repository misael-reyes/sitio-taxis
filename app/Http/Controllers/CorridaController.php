<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Cab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorridaController extends Controller
{
    public function index()
    {
        $datos['corridas']= Corrida::paginate(20);
        return view('admin.corrida.index', $datos);
    }

    public function create()
    {
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->join('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->where('cabs.rol','=','ruta')
            ->get();

       // $taxis = Cab::all();
        return view('admin.corrida.create', compact('taxis'));
    }

    public function store(Request $request)
    {
        /*
        $campos=[
            'hora_salida'=>'required',
            'origen'=>'required|string|max:40',
            'destino'=>'required|string|max:40',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'salida.required'=>'La hora de salida es requerida',
        ];
        $this->validate($request, $campos, $mensaje);
        */
        $datosCorrida = request()->except('_token');
        Corrida::insert($datosCorrida);
        return redirect('corrida')->with('mensaje','Corrida agregada con éxito');
    }

    public function show(Corrida $corrida)
    {
    }

    public function edit($id)
    {
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->join('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->where('cabs.rol','=','ruta')
            ->get();
        //$taxis = Cab::all();
        $corrida = Corrida::findOrFail($id);
        return view('admin.corrida.edit', compact('corrida'), compact('taxis'));
    }

    public function update(Request $request, $id)
    {
        /*
        $campos=[
            'hora_salida'=>'required',
            'origen'=>'required|string|max:40',
            'destino'=>'required|string|max:40',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'salida.required'=>'La hora de salida es requerida',
        ];
        $this->validate($request, $campos, $mensaje);*/
        $datosCorrida = request()->except(['_token','_method']);
        Corrida::where('id','=',$id)->update($datosCorrida); //actualizamos en la BD
        return redirect('corrida')->with('mensaje', 'Corrida modificada');
    }

    public function destroy($id)
    {
        Corrida::destroy($id);
        return redirect('corrida')->with('mensaje','Corrida eliminada');
    }
}
