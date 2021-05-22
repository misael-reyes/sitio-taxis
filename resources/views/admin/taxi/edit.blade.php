@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form">

    <form action="{{ url('/taxi/'.$taxi->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('admin.taxi.form',['modo'=>'Editar']);
    </form>
</div>
@endsection