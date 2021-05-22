@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form">

    @if(Session::has('mensaje'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ url('/taxi') }}" method="post">
        @csrf
        @include('admin.taxi.form',['modo'=>'Registrar']);
    </form>
</div>
@endsection