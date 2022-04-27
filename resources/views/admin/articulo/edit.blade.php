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
    <h1>Editar Artículo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($articulo, ['route' => ['admin.articulos.update', $articulo], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            {{ @method_field('PATCH') }}
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre Artículo: </label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $articulo->nombre) }}"
                        class="form-control" tabindex="1" autofocus>
                    @if ($errors->has('nombre'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('nombre') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $articulo->modelo) }}"
                        class="form-control" tabindex="2">
                    @if ($errors->has('modelo'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('modelo') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="codigo">Codigo: </label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $articulo->codigo) }}"
                        class="form-control" tabindex="3" autofocus>
                    @if ($errors->has('codigo'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('codigo') }}</span>
                        </div>
                    @endif
                </div>
                <div class=" form-group col-md-6">
                    <label for="stock">Stock: </label>
                    <input type="number" name="stock" id="stock" min="0" max="100"
                        value="{{ old('stock', $articulo->stock) }}" class="form-control" tabindex="4" step="1"
                        oninput="validity.valid||(value='')">
                    @if ($errors->has('stock'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('stock') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="marca_id">Marca: </label>
                    <select class="form-control" name="marca_id" id="marca_id" tabindex="5">
                        @foreach ($marcas as $marca)
                            @if ($marca->id == $articulo->marca_id)
                                <option value="{{ $marca->id }}" selected>{{ $marca->nombre_marcas }}</option>
                            @else
                                <option value="{{ $marca->id }}">{{ $marca->nombre_marcas }}</option>
                            @endif
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
                    <input type="number" name="precio_venta" step="0.01" min="0" max="50000" id="precio_venta"
                        value="{{ old('precio_venta', $articulo->precio_venta) }}" class="form-control" tabindex="6">
                    @if ($errors->has('precio_venta'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('precio_venta') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="tipo_id">Tipo de equipo: </label>
                    <select class="form-control" name="tipo_id" id="tipo_id" tabindex="7">
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $articulo->tipo_id)
                                <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre_equipo }}</option>
                            @else
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre_equipo }}</option>
                            @endif
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
                            @if ($proveedor->id == $articulo->proveedor_id)
                                <option value="{{ $proveedor->id }}" selected>{{ $proveedor->razon_social }}</option>
                            @else
                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('proveedor_id'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('proveedor_id') }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" tabindex="9">Actualizar </button>
            <a href="{{ route('admin.articulos.index') }}" class="btn btn-secondary  ml-2 " tabindex="10">Cancelar</a>

            {!! Form::close() !!}
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
