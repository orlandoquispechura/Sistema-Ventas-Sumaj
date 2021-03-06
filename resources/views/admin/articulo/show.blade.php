@extends('adminlte::page')

@section('title', 'Información de los Equipos')

@section('content_header')
    <div class="form-row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-xl-12">
            <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
                echo date('d/m/Y');
            @endphp</h5>
        </div>
    </div>
    <h1>Información del equipo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="border-bottom text-center pb-2">
                        <h3>{{ ucwords($articulo->nombre) }}</h3>
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    <div class="py-4">
                        {{-- ARTICULO SEGUN PROVEEDOR --}}
                        <p class="clearfix">
                            <span class="float-left text-bold">
                                Proveedor
                            </span>
                            <span class="float-right">
                                <h6>{{ ucwords($articulo->proveedor->razon_social) }}</h6>
                            </span>
                            <hr>
                        </p>
                        <p class="clearfix">
                            <span class="float-left text-bold">
                                Marca &nbsp; / &nbsp; Tipo de equipo
                            </span>
                            <span class="float-right">
                                {{-- PRODUCTOS POR MARCA --}}
                                <h6 ><i class="fas fa-certificate"></i> {{ ucwords($articulo->marca->nombre_marcas) }}
                                    {{-- PRODUCTOS POR TIPO --}}
                                    &nbsp; - &nbsp; <i class="fas fa-certificate"></i> {{ ucwords($articulo->tipo->nombre_equipo) }}</h6>
                            </span>
                            <hr>
                        </p>
                        <p class="clearfix">
                        </p>
                    </div>
                </div>
                <div class="col-lg-8 pl-lg-5">
                    <div class="profile-feed">
                        <div class="d-flex align-items-start profile-feed-item">

                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-sort-numeric-up mr-1"></i> Código</strong>
                                <p class="text-muted">
                                    {{ $articulo->codigo }}
                                </p>
                                <hr>
                                <strong><i class="fab fa-contao mr-1"></i> Stock</strong>
                                <p class="text-muted">
                                    {{ $articulo->stock }}
                                </p>
                                <hr>
                            </div>
                            <div class="form-group col-md-6">
                                <strong>
                                    <i class="fas fa-money-bill-alt mr-1"></i>
                                    Precio de venta</strong>
                                <p class="text-muted">
                                    {{ $articulo->precio_venta }} Bs.
                                </p>
                                <hr>
                                <strong><i class="fas fa-barcode mr-1"></i> Código de barras</strong>
                                <p class="text-muted">
                                    {!! DNS1D::getBarcodeHTML($articulo->codigo, 'C128') !!}
                                <p style="letter-spacing: 9px; margin-left:0px;">{{ $articulo->codigo }}</p>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('admin.articulos.index') }}" class="btn btn-secondary float-right">Regresar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')
@stop
