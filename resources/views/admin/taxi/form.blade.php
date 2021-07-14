<h1>{{ $modo }} datos Taxi</h1>
<br>
<br>
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="placa" class="is-required"> Placa </label>
    <input type="text" class="form-control" name="placa" 
    value="{{ isset($taxi->placa)?$taxi->placa:old('placa') }}" 
    id="placa" pattern="[0-9]{2}-[0-9]{2}-SJ[A-Z]{1}" maxlength="9" 
    required>
</div>
<div class="form-group">
    <label for="marca" class="is-required"> Marca </label>
    <input type="text" class="form-control" name="marca" value="{{ isset($taxi->marca)?$taxi->marca:old('marca') }}" id="marca"
    pattern="[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*" required>

</div>
<div class="form-group">
    <label for="modelo" class="is-required"> Modelo </label>
    <input type="text" class="form-control" name="modelo" value="{{ isset($taxi->modelo)?$taxi->modelo:old('modelo') }}" id="modelo"
    pattern="[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*" required>
</div>
<div class="form-group">
    <label for="year" class="is-required"> Año </label>
    <input type="text" class="form-control" name="year" value="{{ isset($taxi->year)?$taxi->year:old('year') }}" id="year"
    pattern="(1|2){1}[0-9]{3}" maxlength="4" required>
</div>
<div class="form-group">
    <label for="rol"> Servicio </label>
    <br>
    <input type="radio" id="local" name="rol" value="local" checked />
    <label for="local">Local &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    
    <input type="radio" id="ruta" name="rol" value="ruta" />
    <label for="ruta">Ruta</label>
</div>
<div class="ok">
    <input class="btn btn-success" type="submit" value="Guardar datos">
</div>
<div class="cancelar">
    <a class="btn btn-danger" href="{{ url('taxi/') }}"> Regresar </a>
</div>
<script>
    var myVar = setInterval(function() {
        myTimer()
    }, 1000);

    function myTimer() {
        var hora = new Date();
        var myhora = hora.toLocaleTimeString();
        
        let hoursActive = ['7:50:00','8:20:00','8:50:00','9:20:00','9:50:00',
        '10:20:00','10:50:00','11:20:00','11:50:00','12:20:00','12:50:00',
        '13:20:00','13:50:00','14:20:00','14:50:00','15:20:00','15:50:00',
        '16:20:00','16:50:00','17:20:00','17:50:00'];

        if (hoursActive.includes(myhora)) {
            let continuar = confirm("La corrida de las " + " " + myhora + " " + "está proxima a salir, verifique que todas las reservaciones se hayan pagado");
            if(continuar){
                window.location='/reservacion'; 
            }
        }
    }
</script>