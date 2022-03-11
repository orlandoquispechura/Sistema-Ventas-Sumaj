@extends('adminlte::page')

@section('title', 'Tipos')

@section('content_header')
<div class="form-row">
    <div class="col-md-6"></div>
    <div class="col-md-6 col-xl-12">
        <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
            echo date('d/m/Y');
        @endphp</h5>
    </div>
</div>
    <h1>Editar Tipo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($tipo, ['route' => ['admin.tipos.update', $tipo], 'method' => 'POST']) !!}
            @csrf
            {{ @method_field('PATCH') }}
            <div class="form-group">
                <label for="nombre_equipo" >Nombre de la Marca: </label>
                <input type="text" name="nombre_equipo" id="nombre_equipo" value="{{ old('nombre_equipo', $tipo->nombre_equipo) }}"
                    class="form-control" tabindex="1" autofocus>
                @if ($errors->has('nombre_equipo'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('nombre_equipo') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción: </label>
                <textarea name="descripcion" id="descripcion" class="form-control"
                    tabindex="2">{{ old('descripcion', $tipo->descripcion) }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('descripcion') }}</span>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success mr-2 " tabindex="3">Actualizar </button>
            <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary" tabindex="4">Cancelar</a>

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
