@extends('adminlte::page')
@section('title', 'Artículo')
@section('content_header')
    <div class="form-row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-xl-12">
            <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
                echo date('d/m/Y');
            @endphp</h5>
        </div>
    </div>
    <h1>Crear Artículo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.articulos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre Artículo: </label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control"
                            tabindex="1" autofocus>
                        @if ($errors->has('nombre'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('nombre') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="modelo">Modelo: </label>
                        <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}" class="form-control"
                            tabindex="2">
                        @if ($errors->has('modelo'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('modelo') }}</span>
                            </div>
                        @endif
                    </div>                   
                    <div class="form-group col-md-6">
                        <label for="codigo">Código: </label>
                        <input type="text" name="codigo" id="cantidad" value="{{ old('codigo') }}" class="form-control"
                            tabindex="3">
                        @if ($errors->has('codigo'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('codigo') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="serie">Serie: </label>
                        <input type="text" name="serie" id="serie" value="{{ old('serie') }}"
                            class="form-control" tabindex="4">
                        @if ($errors->has('serie'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('serie') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="marca_id">Marca: </label>
                        <select class="form-control" name="marca_id" id="marca_id" tabindex="5">

                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre_marcas }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('marca_id'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('marca_id') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="precio_venta">Precio Venta: </label>
                        <input type="number" name="precio_venta" step="0.01" min="0" max="10000" id="precio_venta"
                            value="precio_venta" class="form-control" tabindex="6">
                        @if ($errors->has('precio_venta'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('precio_venta') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipo_id">Tipo de Equipo: </label>
                        <select class="form-control" name="tipo_id" id="tipo_id" tabindex="7">

                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre_equipo }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tipo_id'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('tipo_id') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="proveedor_id">Proveedor: </label>
                        <select class="form-control" name="proveedor_id" id="proveedor_id" tabindex="8">
                            @foreach ($proveedors as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('proveedor_id'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('proveedor_id') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success" tabindex="9">Guardar </button>
                <a href="{{ route('admin.articulos.index') }}" class="btn btn-secondary  ml-2 " tabindex="10">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')
    <script>
        $("#precio_venta").blur(function() {
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
@stop
