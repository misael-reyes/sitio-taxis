<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\Cab;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index()
    {
        $datos['choferes'] = Driver::paginate(5);
        return view('admin.chofer.index', $datos);
    }

    public function create()
    {
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->leftJoin('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->whereNull('drivers.cab_id')
            ->get();
        //$taxis = Cab::all();

        return view('admin.chofer.create', compact('taxis'));
    }

    public function store(Request $request)
    {
        /*
        $campos=[
            'nombre'=>'required|string|max:40',
            'apellidoPaterno'=>'required|string|max:40',
            'apellidoMaterno'=>'required|string|max:40',
            'num_celular'=>'required|string|max:10',
            'dir_calle'=>'required|string|max:40',
            'dir_numero'=>'required|string|max:10',
            'dir_localidad'=>'required|string|max:40',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'dir_calle.required'=>'La calle es requerida',
            'dir_localidad.required'=>'La localidad es requerida'
        ];
        $this->validate($request, $campos, $mensaje);
        */
        $datosChofer = request()->except('_token');
        try {
            Driver::insert($datosChofer);
            return redirect('chofer')->with('mensaje', 'Chofer agregado con éxito');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('chofer/create')->with('mensaje', 'Número telefónico duplicado, inserte otro');
        }
    }

    public function show(Driver $driver)
    {
    }

    public function edit($id)
    {
        $taxis = DB::table('cabs')
            ->select('cabs.id')
            ->leftJoin('drivers', 'cabs.id', '=', 'drivers.cab_id')
            ->whereNull('drivers.cab_id')
            ->get();

        //$taxis = Cab::all();
        $chofer = Driver::findOrFail($id);
        return view('admin.chofer.edit', compact('chofer'), compact('taxis'));
    }

    public function update(Request $request, $id)
    {
        /*
        $campos=[
            'nombre'=>'required|string|max:40',
            'apellidoPaterno'=>'required|string|max:40',
            'apellidoMaterno'=>'required|string|max:40',
            'num_celular'=>'required|string|max:10',
            'dir_calle'=>'required|string|max:40',
            'dir_numero'=>'required|string|max:10',
            'dir_localidad'=>'required|string|max:40',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'dir_calle.required'=>'La calle es requerida',
            'dir_localidad.required'=>'La localidad es requerida'
        ];
        $this->validate($request, $campos, $mensaje);
        */
        $datosChofer = request()->except(['_token', '_method']);
        Driver::where('id', '=', $id)->update($datosChofer); //actualizamos en la BD
        return redirect('chofer')->with('mensaje', 'Chofer modificado');
    }

    public function destroy($id)
    {
        Driver::destroy($id);
        return redirect('chofer')->with('mensaje', 'Chofer eliminado');
    }
}
