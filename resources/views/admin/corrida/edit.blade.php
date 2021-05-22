@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form">

    <form action="{{ url('/corrida/'.$corrida->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('admin.corrida.form',['modo'=>'Editar']);
    </form>
</div>
@endsection