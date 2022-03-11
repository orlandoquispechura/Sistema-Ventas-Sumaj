@extends('adminlte::page')

@section('title', 'Marcas')

@section('content_header')
    <div class="form-row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-xl-12">
            <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
                echo date('d/m/Y');
            @endphp</h5>
        </div>
    </div>
    <h1>Editar Marca</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            {!! Form::model($marca, ['route' => ['admin.marcas.update', $marca], 'method' => 'POST']) !!}
            @csrf
            {{ @method_field('PATCH') }}
            <div class="form-group">
                <label for="nombre_marcas">Nombre de la Marca: </label>
                <input type="text" name="nombre_marcas" id="nombre_marcas"
                    value="{{ old('nombre_marcas', $marca->nombre_marcas) }}" class="form-control" tabindex="1"
                    autofocus>
                @if ($errors->has('nombre_marcas'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('nombre_marcas') }}</span>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success mr-2 " tabindex="2">Actualizar </button>
            <a href="{{ route('admin.marcas.index') }}" class="btn btn-secondary" tabindex="3">Cancelar</a>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')
@stop
