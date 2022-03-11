@extends('adminlte::page')

@section('title', 'Detalles de Compra')

@section('content_header')
<div class="form-row">
    <div class="col-md-6"></div>
    <div class="col-md-6 col-xl-12">
        <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
            echo date('d/m/Y');
        @endphp</h5>
    </div>
</div>
    <h1>Compras</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <label class="form-control-label" for="nombre"><strong>Proveedor</strong></label>
                    <p>{{ ucwords($compra->proveedor->razon_social) }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <label class="form-control-label" for="num_compra"><strong>Número Compra</strong></label>
                    <p>{{ $compra->id }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <label class="form-control-label" for="num_compra"><strong>Usuario</strong></label>
                    <p>{{ ucwords($compra->user->name) }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <label class="form-control-label" for="nombre"><strong>Fecha</strong></label>
                    <p>{{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d-M-y H:i a') }}</p>
                </div>
            </div>
            <div class="form-group row">
                <h4 class="card-title ml-3 text-bold">Detalles de compra</h4>
                <div class="table-responsive col-md-12 table-bordered shadow-lg">
                    <table id="detalles" class="table table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Item</th>
                                <th>Producto</th>
                                <th>Precio (Bs)</th>
                                <th>Cantidad</th>
                                <th style="text-align: right; width: 200px;">SubTotal (Bs)</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    <p align="right">TOTAL:</p>
                                </th>
                                <th>
                                    <p align="left">Bs. {{ number_format($compra->total, 2) }}</p>
                                </th>
                            </tr>

                        </tfoot>
                        <tbody>
                            @foreach ($detallecompras as $detallecompra)
                                <tr>
                                    <td>{{$detallecompra->articulo->id}}</td>
                                    <td>{{ ucwords($detallecompra->articulo->nombre) }}</td>
                                    <td>Bs. {{ $detallecompra->precio_compra }}</td>
                                    <td>{{ $detallecompra->cantidad }}</td>
                                    <td align="left">Bs. {{number_format($detallecompra->cantidad * $detallecompra->precio_compra, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary float-right">Regresar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

@stop

@section('js')

@stop
