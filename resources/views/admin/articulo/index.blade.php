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
    <h1>Listado de Artículos</h1>
@stop

@section('content')
    @can('articulos.create')
        <a href="{{ route('admin.articulos.create') }}" class="btn btn-secondary mb-2">Crear Equipos +</a>
    @endcan
    {{-- <a class="btn btn-warning mb-2" href="{{ route('print_barcode') }}" target="_blank">Exportar códigos de barras</a> --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Guardado!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong> Editado!</strong> {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4" id="articulo">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col" width='100px'>Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Modelo - Serie</th>
                        <th scope="col">Stock</th>
                        <th>Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->codigo }}</td>
                            <td>{{ Str::ucfirst($articulo->nombre) }}
                            <td>{{ $articulo->modelo }} - {{ $articulo->serie }}</td>
                            <td>{{ $articulo->stock }}</td>
                            @if ($articulo->estado == 'ACTIVO')
                                <td>
                                    <a class="jsgrid-button btn btn-success"
                                        href="{{ route('cambio.estado.articulos', $articulo) }}">
                                        Activo <i class="fas fa-check"></i>
                                    </a>
                                </td>
                            @else
                                <td>
                                    <a class="jsgrid-button btn btn-danger"
                                        href="{{ route('cambio.estado.articulos', $articulo) }}">
                                        Inactivo <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            @endif
                            <td>
                                @can('articulos.show')
                                    <a href="{{ route('admin.articulos.show', $articulo) }}" class="btn btn-info"><i
                                            class="fas fa-eye"></i></a>
                                @endcan
                                @can('articulos.edit')
                                    <a class="btn btn-secondary"
                                        href="{{ route('admin.articulos.edit', $articulo) }}"><i
                                            class="fas fa-pen-alt"></i></a>
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
        $('.eliminar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Quieres eliminar?',
                text: "El registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @if (session('delete') == 'ok')
        <script>
            Swal.fire(
                'Eliminar!',
                'Se Eliminó el registro.',
                'warning'
            )
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $('#articulo').DataTable({
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
                    "infoEmpty": "No records available",
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
