@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form">

    <form action="{{ url('/corrida') }}" method="post">
        @csrf
        @include('admin.corrida.form',['modo'=>'Registrar']);
    </form>
</div>
@endsection