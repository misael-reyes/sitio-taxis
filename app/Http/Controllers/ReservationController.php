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
use DateTime;
use phpDocumentor\Reflection\Location;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Illuminate\Support\Collection;

/**
 * ReservationController
 * clase para manipular las reservaciones (reservar como cancelar)
 */
class ReservationController extends Controller
{

    /**
     * muestra todas las corridas disponibles para que el usuario pueda seleccionar una y empezar
     * a reservar
     *
     * @return view vista donde se muestran las corridas
     */
    public function mostrarCorridas()
    {
        //"hora_salida":"08:00:00"
        //consultamos en la base de datos las corridas disponibles
        $hora = $this->hora();
        $hora_sin_segundos = $this->hora2();
        //$corridas = DB::table('corridas')->where('hora_salida', '>=', $hora)->get();
        $corridas = Corrida::all();
        //obtenemos la primera corrida que nos devolvio la consulta
        if (count($corridas) > 0) {
            $firstcorrida = $corridas[0];
        }
        //return response()->json($firstcorrida->id);

        /**
         * primero tengo que obtener la hora de salida de la corrida más proxima
         * compararla con la misma hora 10 min antes
         */
        //hora de la corrida más proxima
        $hora_corrida = $corridas[0]->hora_salida;
        //return response()->json($hora_corrida);
        $horas = [
            '7:50', '8:20', '8:50', '9:20', '9:50',
            '10:20', '10:50', '11:20', '11:50', '12:20', '12:50',
            '13:20', '13:50', '14:20', '14:50', '15:20', '15:50',
            '16:20', '16:50', '17:20', '17:50'
        ];

        if (in_array($hora_sin_segundos, $horas)) {
            //si entra quiere decir que si faltan 10 min para la siguiente corrida
            $consulta = DB::table('reservation_details')
                ->select('reservation_details.num_asiento', 'reservations.cliente', 'reservations.id')
                ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
                ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
                ->where('corridas.id', '=', $firstcorrida->id)
                ->where('reservations.fecha_reservacion', '=', $this->fecha())
                ->where('reservation_details.estatus', '=', 'activo')
                ->where('reservations.estatus_pago', '=', 'apartado')
                ->get();
            //return response()->json($consulta[0]->id);
            if (count($consulta) > 0) {
                foreach ($consulta as $c) {
                    DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?', [$c->id, $firstcorrida->id, $c->num_asiento]);
                }
                return redirect('reservacion/')->with('mensaje', 'Los asientos del pasajero ' . $consulta[0]->cliente . ' fueron cancelados, ya que aún no se presenta y su corrida sale en 10 min');
            }
        }

        return view('admin.reservacion.corridas', compact('corridas'));
    }

    /**
     * muestra la vista para reservar los asientos, vamos a tomar los datos del formulario y se 
     * los vamos a pasar a la vista generar boletos
     *
     * @param  mixed $id identificador de la corrida que se eligió
     * @return view vista donde empezaremos a reservar
     */
    public function reservarAsiento($id)
    {
        $destino = request()->except('_token');
        //consultamos que asientos ya se encuentran apartados para esta corrida
        $consulta = DB::table('reservation_details')
            ->select('reservation_details.num_asiento')
            ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->where('corridas.id', '=', $id)
            ->where('reservations.fecha_reservacion', '=', $this->fecha())
            ->where('reservation_details.estatus', '=', 'activo')
            ->get();
        $tamano = count($consulta);
        if ($tamano >= 4) {
            return redirect('reservacion/')->with('mensaje', 'No hay asientos disponibles en dicha corrida');
        }
        //corrida elegida
        $corrida = Corrida::findOrFail($id);
        //destinos intermedios
        $intermedios = DB::table('precios')->orderBy('id', 'desc')->get();
        return view('admin.reservacion.reservaciones', compact('corrida', 'intermedios', 'consulta', 'tamano'));
    }

    /**
     * aqui vamos a tomar los datos que nos pasen de la vista reservaciones, generamos los boletos
     * y si todo esta bien, hacemos los registros a las base de datos correspondiente
     *
     * @param  mixed $id id de la corrida elegida
     * @return void
     */
    public function generarBoletos($id)
    {
        $asiento = 0;
        $destino = "";
        $bandera1 = true;
        $bandera2 = true;
        $bandera3 = true;
        $bandera4 = true;

        $datos2 = request()->except('_token');
        //return request()->json($datos2);
        //validamos cuantos boletos vamos a generar
        $boletosAgenerar = 0;
        if (isset($datos2["num_asiento1"])) {
            $boletosAgenerar++;
        }
        if (isset($datos2["num_asiento2"])) {
            $boletosAgenerar++;
        }
        if (isset($datos2["num_asiento3"])) {
            $boletosAgenerar++;
        }
        if (isset($datos2["num_asiento4"])) {
            $boletosAgenerar++;
        }
        $user = auth()->user();
        //datos para la tabla reservations
        $datos = array(
            //"estatus_pago" => $datos2["estatus_pago"],
            "estatus_pago" => "pagado",
            "costo_total" => $datos2["total"],
            "cliente" => $datos2["cliente"],
            "fecha_reservacion" => $this->fecha(),
            "user_id" => $user->id,
        );

        //validamos si se eligieron asientos
        if ($boletosAgenerar != 0) {
            //insertamos datos a la tabla reservations
            $registro = Reservation::insert($datos);
            //obtenemos el id del registro recien ingresado
            $id_registro = DB::getPdo()->lastInsertId();
        }

        //clasificamos los destinos intermedios
        for ($i = 0; $i < $boletosAgenerar; $i++) {
            if (isset($datos2["num_asiento1"]) && $bandera1 == true) {
                $asiento = 1;
                $destino = $datos2["destino_intermedio"];
                $bandera1 = false;
            } else
            if (isset($datos2["num_asiento2"]) && $bandera2 == true) {
                $asiento = 2;
                $destino = $datos2["destino_intermedio"];
                $bandera2 = false;
            } else
            if (isset($datos2["num_asiento3"]) && $bandera3 == true) {
                $asiento = 3;
                $destino = $datos2["destino_intermedio"];
                $bandera3 = false;
            } else
            if (isset($datos2["num_asiento4"]) && $bandera4 == true) {
                $asiento = 4;
                $destino = $datos2["destino_intermedio"];
                $bandera4 = false;
            }

            //obtenemos los precios de los destinos
            $precio = Precio::select('id')
                ->where('destino_intermedio', $destino)
                ->get();

            //datos para registrar en la tabla reservation_details
            $datosDetalle = array(
                "num_asiento" => $asiento,
                "estatus" => "activo",
                "reservation_id" => $id_registro,
                "corrida_id" => $id,
                "precio_id" => $precio[0]["id"]
            );
            Reservation_detail::insert($datosDetalle);
        }

        //mostramos los boletos en caso de haber reservado asientos
        if ($boletosAgenerar != 0) {
            return view('admin.reservacion.boletos', compact('datos2', 'boletosAgenerar', 'id', 'id_registro'));
        } else {
            return redirect('reservacion/' . $id . '/asientos')->with('mensaje', 'No has seleccionado asientos');
        }
    }

    /**
     * función para mostrar la vista donde se cancelara un asiento
     *
     * @param  mixed $id id de la corrida seleccionada
     * @return view vista de cancelación
     */
    public function cancelarReservacion($id)
    {
        $asientos = array();
        $corrida = Corrida::findOrFail($id);
        return view('admin.reservacion.cancelacion', compact('corrida', 'asientos'));
    }

    /**
     * haremos la cancelación
     *
     * @param  mixed $id id de la corrida seleccionada
     * @return view vista de cancelación
     */
    public function cancelar($id)
    {
        $corrida = Corrida::findOrFail($id);
        //recuperamos los datos de la cancelación
        $datosDeCancelacion = request()->except(['_token', '_method']);
        //hacemos la cancelación, actualizamos en la base de datos
        DB::update('update reservation_details set estatus = "cancelado" where reservation_id = ? AND corrida_id = ? AND num_asiento = ?', [$datosDeCancelacion['id_reservacion'], $id, $datosDeCancelacion['asien']]);
        //buscamos los asientos que reservo dicho cliente nuevamente
        $asientos = DB::table('reservation_details')
            ->select('reservation_details.num_asiento', 'reservations.cliente', 'reservations.id')
            ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->where('corridas.id', '=', $id)
            ->where('reservations.fecha_reservacion', '=', $this->fecha())
            ->where('reservation_details.estatus', '=', 'activo')
            ->where('reservations.estatus_pago', '=', 'apartado')
            ->where('reservations.cliente', '=', $datosDeCancelacion["name"])
            ->get();
        //mostramos los asientos que faltan por cancelar
        return view('admin.reservacion.cancelacion', compact('corrida', 'asientos'));
    }

    /**
     * buscamos el cliente por su nombre
     *
     * @param  mixed $id id de la corrida seleccionada
     * @return view vista de cancelación
     */
    public function buscarCliente($id)
    {
        //recuperamos el nombre del cliente
        $nombre_cliente = request()->except('_method');
        $corrida = Corrida::findOrFail($id);
        //buscamos en la base de datos el nombre del cliente
        $asientos = DB::table('reservation_details')
            ->select('reservation_details.num_asiento', 'reservations.cliente', 'reservations.id')
            ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->where('corridas.id', '=', $id)
            ->where('reservations.fecha_reservacion', '=', $this->fecha())
            ->where('reservation_details.estatus', '=', 'activo')
            ->where('reservations.estatus_pago', '=', 'apartado')
            ->where('reservations.cliente', '=', $nombre_cliente["cliente"])
            ->get();
        $tamano =  count($asientos);
        //validamos si se encontro al cliente
        if ($tamano == 0) {
            return redirect('reservacion/' . $id . '/cancelar')->with('mensaje', 'Pasajero no encontrado o Boletos pagados');
        }
        //mostramos sus asientos reservados de dicho cliente
        return view('admin.reservacion.cancelacion', compact('corrida', 'asientos'));
    }

    /**
     * consultamos la fecha del sistema
     *
     * @return view fecha actual del sistema
     */
    public function fecha()
    {
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $fechaHoy = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"];
        return $fechaHoy;
    }

    //"08:00:00"
    public function hora()
    {
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $horaHoy = $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        return $horaHoy;
    }

    public function hora2()
    {
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $horaHoy = $hoy["hours"] . ":" . $hoy["minutes"];
        return $horaHoy;
    }

    public function guardarBoletos($id)
    {
        DB::update('update reservations set estatus_pago = "apartado" where id = ?', [$id]);
        return redirect('reservacion/')->with('mensajeexito','Boletos reservados');
    }

    /**
     * vista donde se mostrara el bucador de las reservaciones de las que se generaran los boletos
     */
    public function cobrar($id)
    {
        $reservaciones = array();
        $corrida = Corrida::findOrFail($id);
        return view('admin.reservacion.buscarboletos', compact('corrida', 'reservaciones'));
    }

    public function buscarBoleto($id)
    {
        //recuperamos el nombre del cliente
        $nombre_cliente = request()->except('_method');
        $corrida = Corrida::findOrFail($id);
        /*
        $reservaciones = Reservation::where('cliente', '=', $nombre_cliente["cliente"])
            ->where('fecha_reservacion', '=', $this->fecha())
            ->where('estatus_pago', '=', 'apartado')
            ->get();*/

        $reservaciones = DB::table('reservation_details')
            ->select('reservations.id', 'reservations.estatus_pago', 'reservations.costo_total', 'reservations.cliente', 'reservations.fecha_reservacion')
            ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->where('corridas.id', '=', $id)
            ->where('reservations.fecha_reservacion', '=', $this->fecha())
            ->where('reservation_details.estatus', '=', 'activo')
           // ->where('reservations.estatus_pago', '=', 'apartado')
            ->where('reservations.cliente', '=', $nombre_cliente["cliente"])
            ->limit(1)
            ->get();
        //return response()->json($reservaciones[0]->cliente);
        //$reservaciones = $reservaciones2[0];

        $tamano =  count($reservaciones);
        //validamos si se encontro al cliente
        if ($tamano == 0) {
            return redirect('reservacion/' . $id . '/cobrar')->with('mensaje', 'Pasajero no encontrado');
        }
        if($reservaciones[0]->estatus_pago == "pagado"){
            return view('admin.reservacion.buscarboletos2', compact('corrida', 'reservaciones'));
        }

        //mostramos sus asientos reservados de dicho cliente
        return view('admin.reservacion.buscarboletos', compact('corrida', 'reservaciones'));
    }

    public function generarBoletos2($idc, $id)
    {

        //recuperamos los datos de la reservacion
        $reservacion = Reservation::findOrFail($id);
        $corrida = Corrida::findOrFail($idc);

        $asientos = DB::table('reservation_details')
            ->select('reservation_details.num_asiento', 'reservation_details.precio_id')
            ->join('corridas', 'reservation_details.corrida_id', '=', 'corridas.id')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->where('corridas.id', '=', $idc)
            ->where('reservations.fecha_reservacion', '=', $this->fecha())
            ->where('reservation_details.estatus', '=', 'activo')
            ->where('reservations.estatus_pago', '=', 'apartado')
            ->where('reservations.id', '=', $id)
            ->get();
        //return response()->json($asientos[0]->precio_id);

        $precio = Precio::where('id', $asientos[0]->precio_id)->get();
        //actualizamos en la tabla reservaciones el estatus del pago
        DB::update('update reservations set estatus_pago = "pagado" where id = ?', [$id]);
        //mostramos los boletos en caso de haber reservado asientos
        return view('admin.reservacion.boletosr', compact('reservacion', 'asientos', 'corrida', 'precio'));
    }
}
