@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <div class="form-row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-xl-12">
            <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
                echo date('d/m/Y');
            @endphp</h5>
        </div>
    </div>
    <h1>Listado de Ingresos</h1>
@stop

@section('content')
    @can('compras.create')
    <a class="btn btn-secondary mb-2" href="{{ route('admin.compras.create') }}">Registrar compras +</a>
    @endcan
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Guardado!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> Error !</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('cancelado'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('cancelado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="order-listing"
                class="table compra table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d-M-y H:i a') }}
                            </td>
                            <td>{{ ucwords($compra->proveedor->razon_social) }}</td>
                            <td>Bs. {{ number_format($compra->total, 2) }}</td>

                            @if ($compra->estado == 'VALIDO')
                                <td>
                                    <a class="jsgrid-button btn btn-success"
                                        href="{{ route('cambio.estado.compras', $compra) }}" title="Editar">
                                        Activo <i class="fas fa-check"></i>
                                    </a>
                                </td>
                            @else
                                <td>
                                    <a class="jsgrid-button btn btn-danger"
                                        href="{{ route('cambio.estado.compras', $compra) }}" title="Editar">
                                        Cancelado <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            @endif
                            <td style="width:100px;">
                                @can('compras.pdf')
                                    <a href="{{ route('compras.pdf', $compra) }}" class="btn btn-danger" target="_blank"><i
                                            class="fas fa-file-pdf ml-2"></i></a>
                                @endcan
                                @can('compras.show')
                                    <a href="{{ route('admin.compras.show', $compra) }}" class="btn btn-info"><i
                                            class="fas fa-eye"></i> </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.8/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

@stop

@section('js')

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.compra').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
@stop
