@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form2">

    <form action="{{ url('/chofer/'.$chofer->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('admin.chofer.form',['modo'=>'Editar']);
    </form>
</div>
@endsection