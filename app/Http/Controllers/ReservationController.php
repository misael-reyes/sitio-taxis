<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Models\Corrida;
use App\Models\Precio;
use App\Models\Reservation;
use App\Models\Reservation_detail;
use phpDocumentor\Reflection\Location;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Illuminate\Support\Collection;

/**
 * ReservationController
 * clase para manipular las reservaciones
 */
class ReservationController extends Controller {

    /**
     * mostrarCorridas
     * muestra todas las corridas disponibles para que el usuario pueda seleccionar una y empezar
     * a reservar
     *
     * @return void
     */
    public function mostrarCorridas(){
        $corridas = DB::table('corridas')->get();
       
        return view('admin.reservacion.corridas', compact('corridas'));
    }
    
    /**
     * reservarAsiento
     * muestra la vista para reservar los asientos, vamos a tomar los datos del formulario y se 
     * los vamos a pasar a la vista generar boletos
     *
     * @param  mixed $id
     * @return void
     */
    public function reservarAsiento($id){

        $destino = request()->except('_token');

        //obtenemos la fecha del sistema
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];

        $consulta = DB::table('reservation_details')
            ->select('reservation_details.num_asiento')
            ->join('corridas','reservation_details.corrida_id','=','corridas.id')
            ->join('reservations','reservation_details.reservation_id','=','reservations.id')
            ->where('corridas.id','=',$id)
            ->where('reservations.fecha_reservacion','=',$fechaHoy)
            ->where('reservation_details.estatus','=','activo')
            ->get();
            /*
        foreach($consulta as $valor){
            echo $valor->num_asiento;
           
        }*/
        $tamano = count($consulta);
            //return response()->json($hoy);

        $corrida=Corrida::findOrFail($id);
        
        $intermedios = DB::table('precios')->orderBy('id','desc')->get();
        return view('admin.reservacion.reservaciones', compact('corrida', 'intermedios','consulta', 'tamano'));

        
    }
    
    /**
     * generarBoletos
     * aqui vamos a tomar los datos que nos pasen de la vista reservaciones, generamos los boletos
     * y si todo esta bien, hacemos los registros a las base de datos correspondiente
     *
     * @param  mixed $id id de la corrida
     * @return void
     */
    public function generarBoletos($id){
        //$corrida=Corrida::findOrFail($id);
        //$intermedios = DB::table('precios')->orderBy('id','desc')->get();

        $asiento = 0;
        $destino = "";

        $bandera1 = true;
        $bandera2 = true;
        $bandera3 = true;
        $bandera4 = true;

        //tenemos que hacer el registro
        $datos2 = request()->except('_token');

        //obtenemos la fecha del sistema
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];

        $boletosAgenerar = 0;
        if(isset($datos2["num_asiento1"])){
            $boletosAgenerar ++;
        }
        if(isset($datos2["num_asiento2"])){
            $boletosAgenerar ++;
        }
        if(isset($datos2["num_asiento3"])){
            $boletosAgenerar ++;
        }if(isset($datos2["num_asiento4"])){
            $boletosAgenerar ++;
        }

        //datos para la tabla reservations
        $datos = array(
            "estatus_pago" => $datos2["estatus_pago"],
            "costo_total" => $datos2["total"],
            "cliente" => $datos2["cliente"],
            "fecha_reservacion" => $fechaHoy,
            "user_id" => 1
        );

        if($boletosAgenerar != 0){
            $registro = Reservation::insert($datos);
            $id_registro = DB::getPdo()->lastInsertId();
        }
        

        //hacer los registros en detalle_reservacion
        //$mysqli = mysqli_connect('localhost', 'root', '', 'sitio_taxis');
        for($i = 0; $i < $boletosAgenerar; $i++){
            if(isset($datos2["num_asiento1"]) && $bandera1 == true){
                $asiento = 1;
                $destino = $datos2["destino_intermedio1"];
                $bandera1 = false;
            } else
            if(isset($datos2["num_asiento2"]) && $bandera2 == true){
                $asiento = 2;
                $destino = $datos2["destino_intermedio2"];
                $bandera2 = false;
            } else
            if(isset($datos2["num_asiento3"]) && $bandera3 == true){
                $asiento = 3;
                $destino = $datos2["destino_intermedio3"];
                $bandera3 = false;
            } else
            if(isset($datos2["num_asiento4"]) && $bandera4 == true){
                $asiento = 4;
                $destino = $datos2["destino_intermedio4"];
                $bandera4 = false;
            }

            $precio = Precio::select('id')
                ->where('destino_intermedio', $destino)
                ->get();

            $datosDetalle = array(
                "num_asiento" => $asiento,
                "estatus" => "activo",
                "reservation_id" => $id_registro,
                "corrida_id" => $id,
                "precio_id" => $precio[0]["id"]
            );
            Reservation_detail::insert($datosDetalle);
        }

        if($boletosAgenerar != 0){
            return view('admin.reservacion.boletos', compact('datos2', 'boletosAgenerar','id'));
        } else {
            return redirect('reservacion/'.$id.'/asientos')->with('mensaje','No has seleccionado asientos');
            //return view('admin.reservacion.reservaciones', compact('corrida', 'intermedios'));
        }
        //return view('admin.reservacion.boletos', compact('datos2', 'boletosAgenerar','id'));
        //return response()->json(self::$datos);
    }

    public function cancelarReservacion($id){

        //obtenemos la fecha del sistema
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];

        $asientos = DB::table('reservation_details')
            ->select('reservation_details.num_asiento')
            ->join('corridas','reservation_details.corrida_id','=','corridas.id')
            ->join('reservations','reservation_details.reservation_id','=','reservations.id')
            ->where('corridas.id','=',$id)
            ->where('reservations.fecha_reservacion','=',$fechaHoy)
            ->where('reservation_details.estatus','=','activo')
            ->get();

        $corrida=Corrida::findOrFail($id);
        return view('admin.reservacion.cancelacion', compact('corrida', 'asientos'));
        //return response()->json($asientos);
    }

    //aqui haremos la actualización a la base de datos
    public function cancelar($id){

        $datosDeCancelacion = request()->except(['_token','_method']);

        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];

        $asientos = DB::table('reservation_details')
            ->select('reservation_details.num_asiento')
            ->join('corridas','reservation_details.corrida_id','=','corridas.id')
            ->join('reservations','reservation_details.reservation_id','=','reservations.id')
            ->where('corridas.id','=',$id)
            ->where('reservations.fecha_reservacion','=',$fechaHoy)
            ->where('reservations.estatus_pago','=','por pagar')
            ->where('reservations.cliente','=',$datosDeCancelacion["cliente"])
            ->get();
        
        $tamano =  count($asientos);

        $id_reservacion = DB::table('reservation_details')
            ->select('reservation_details.reservation_id')
            ->join('corridas','reservation_details.corrida_id','=','corridas.id')
            ->join('reservations','reservation_details.reservation_id','=','reservations.id')
            ->where('corridas.id','=',$id)
            ->where('reservations.fecha_reservacion','=',$fechaHoy)
            ->where('reservations.estatus_pago','=','por pagar')
            ->where('reservations.cliente','=',$datosDeCancelacion["cliente"])
            ->first();
            //return response()->json($id_reservacion);
        
        //validamos si la consulta nos regreso datos
        if($tamano == 0){
            return redirect('reservacion/'.$id.'/cancelar')->with('mensaje','Nombre incorrecto o reservación pagada');
        }
        $id_reser = $id_reservacion->reservation_id;
        //return response()->json($asientos);

        //validamos que los asientos que eligio el usuario sean los correctos
        $flag = true;
        $asiento1 = 0;
        $asiento2 = 0;
        $asiento3 = 0;
        $asiento4 = 0;
        $asiento = 0;
        $asientosACancelar = 0;

        if(isset($datosDeCancelacion["num_asiento1"])){
            $asiento1 = $datosDeCancelacion["num_asiento1"];
            $flag = $this->recorrer($asientos, $asiento1);
            if($flag == false){ return redirect('reservacion/'.$id.'/cancelar')->with('mensaje','Asiento 1 no valido para ese cliente'); }
            $asientosACancelar ++;
        }
        if(isset($datosDeCancelacion["num_asiento2"])){
            $asiento2 = $datosDeCancelacion["num_asiento2"];
            $flag = $this->recorrer($asientos, $asiento2);
            if($flag == false){ return redirect('reservacion/'.$id.'/cancelar')->with('mensaje','Asiento 2 no valido para ese cliente'); }
            $asientosACancelar ++;
        }
        if(isset($datosDeCancelacion["num_asiento3"])){
            $asiento3 = $datosDeCancelacion["num_asiento3"];
            $flag = $this->recorrer($asientos, $asiento3);
            if($flag == false){ return redirect('reservacion/'.$id.'/cancelar')->with('mensaje','Asiento 3 no valido para ese cliente'); }
            $asientosACancelar ++;
        }
        if(isset($datosDeCancelacion["num_asiento4"])){
            $asiento4 = $datosDeCancelacion["num_asiento4"];
            $flag = $this->recorrer($asientos, $asiento4);
            if($flag == false){ return redirect('reservacion/'.$id.'/cancelar')->with('mensaje','Asiento 4 no valido para ese cliente'); }
            $asientosACancelar ++;
        }

        //ahora hacemos el cambio en la base de datos
        if($asiento1 != 0){
            DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?',[$id_reser,$id,$asiento1]);   
        }
        if($asiento2 != 0){
            DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?',[$id_reser,$id,$asiento2]);   
        }
        if($asiento3 != 0){
            DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?',[$id_reser,$id,$asiento3]);   
        }
        if($asiento4 != 0){
            DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?',[$id_reser,$id,$asiento4]);   
        }
        /*
        $a = Reservation::join('reservation_details','reservations.id','=','reservation_details.corrida_id')
            ->where('corrida_id','=',$id)
            ->where('reservation_id','=',1)
            ->where('num_asiento','=',1)
            ->first();
        $a->estatus = "cancelado";
        $a->save();*/
         
        //return response()->json($a);
        return redirect('/reservacion')->with('mensaje','Cancelación exitosa');
    }

    public function recorrer($matriz, $valor){
        $flag = false;
        foreach($matriz as $item){
            if($valor == $item->num_asiento){
                $flag = true;
            }
        }
        return $flag;
    }

}