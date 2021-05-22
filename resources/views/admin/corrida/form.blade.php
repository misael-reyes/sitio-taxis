<h1>{{ $modo }} datos Corrida</h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br>
<div class="form-group">
    <label for="origen"> Origen </label>
    <input type="text" class="form-control" name="origen" value="San Miguel Suchixtepec" id="origen" readonly>
</div>

<div class="form-group">
    <label for="destino"> Destino </label>
    <input type="text" class="form-control" name="destino" value="Miahuatlan" id="destino" readonly>
</div>

<div class="form-group">
    <label for="hora_salida" class="is-required"> Hora de salida </label>
    <input type="time" class="form-control" name="hora_salida" value="{{ isset($corrida->hora_salida)?$corrida->hora_salida:old('hora_salida') }}" id="hora_salida">
</div>

<div class="form-group">
    <label for="cab_id" class="is-required"> Asignar Taxi </label>
    <select class="form-control" name="cab_id" value="{{ isset($corrida->cab_id)?$corrida->cab_id:old('cab_id') }}" id="cab_id">
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

<div class="ok">
    <input class="btn btn-success" type="submit" value="Guardar datos">
</div>

<div class="cancelar">
    <a class="btn btn-danger" href="{{ url('corrida/') }}"> Regresar </a>
</div>