<h1>{{ $modo }} datos Chofer</h1>
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
<fieldset>
    <legend>Datos personales</legend>
    <div class="form-group">
        <label for="nombre" class="is-required"> Nombre </label>
        <input type="text" class="form-control" name="nombre" value="{{ isset($chofer->nombre)?$chofer->nombre:old('nombre') }}" id="nombre" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" required>
    </div>

    <div class="form-group">
        <label for="apellidoPaterno" class="is-required"> Primer apellido </label>
        <input type="text" class="form-control" name="apellidoPaterno" value="{{ isset($chofer->apellidoPaterno)?$chofer->apellidoPaterno:old('apellidoPaterno') }}" id="apellidoPaterno" required>
    </div>

    <div class="form-group">
        <label for="apellidoMaterno"> Segundo apellido </label>
        <input type="text" class="form-control" name="apellidoMaterno" value="{{ isset($chofer->apellidoMaterno)?$chofer->apellidoMaterno:old('apellidoMaterno') }}" id="apellidoMaterno">
    </div>

    <div class="form-group">
        <label for="num_celular" class="is-required"> Número de celular </label>
        <input type="text" class="form-control" name="num_celular" value="{{ isset($chofer->num_celular)?$chofer->num_celular:old('num_celular') }}" id="num_celular" pattern="[1-9]{2}[0-9]{8}" maxlength="10" required>
    </div>
</fieldset>

<fieldset>
    <legend>Dirección</legend>
    <div class="form-group">
        <label for="dir_calle" class="is-required"> Calle </label>
        <input type="text" class="form-control" name="dir_calle" value="{{ isset($chofer->dir_calle)?$chofer->dir_calle:old('dir_calle') }}" id="dir_calle" required>
    </div>

    <div class="form-group">
        <label for="dir_numero" class="is-required"> Número </label>
        <input type="text" class="form-control" name="dir_numero" value="{{ isset($chofer->dir_numero)?$chofer->dir_numero:old('dir_numero') }}" id="dir_numero" required>
    </div>

    <div class="form-group">
        <label for="dir_localidad" class="is-required"> Localidad </label>
        <input type="text" class="form-control" name="dir_localidad" value="{{ isset($chofer->dir_localidad)?$chofer->dir_localidad:old('dir_localidad') }}" id="dir_localidad" required>
    </div>

    <div class="form-group">
        <label for="cab_id" class="is-required"> Asignar Taxi </label>
        <select class="form-control" name="cab_id" value="{{ isset($chofer->cab_id)?$chofer->cab_id:old('cab_id') }}" id="cab_id">
            @foreach($taxis as $taxi)
            <?php
            $str = strval($taxi->id);
            for ($i = strlen($str); $i < 3; $i++) {
                $str = "0" . $str;
            }
            ?>
            <option value="{{ $taxi->id }}">{{ $str }}</option>
            @endforeach
        </select>
    </div>


</fieldset>

<div class="ok2">
    <input class="btn btn-success" type="submit" value="Guardar datos">
</div>
<div class="cancelar2">
    <a class="btn btn-danger" href="{{ url('chofer/') }}"> Regresar </a>
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