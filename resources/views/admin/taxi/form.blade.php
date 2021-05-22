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