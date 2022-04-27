@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <div class="form-row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-xl-12">
            <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
                echo date('d/m/Y');
            @endphp</h5>
        </div>
    </div>
    <div class="form-row mt-2">
        <div class="col-md-6">
            <h1>Registrar Venta</h1>
        </div>
        <div class="col-md-6 ">
            <button type="button" class="btn btn-warning float-right font-weight-bold" data-toggle="modal"
                data-target="#exampleModal-2">
                Registrar cliente +
            </button>
        </div>
    </div>
@stop

@section('content')
    @if (session('cliente_venta'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Guardado!</strong> {{ session('cliente_venta') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        {!! Form::open(['route' => 'admin.ventas.store', 'method' => 'POST']) !!}
        <div class="card-body">
            @include('admin.venta._form')
        </div>
        <div class="card-footer text-muted">
            <button type="submit" id="guardar" class="btn btn-success float-right">Registrar</button>
            <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Registro rápido de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.clientes.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="razon_social">Nombre Cliente: </label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                class="form-control" tabindex="1" data-autofocus required>
                            @if ($errors->has('nombre'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('nombre') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido_paterno">Apellido Paterno: </label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno"
                                value="{{ old('apellido_paterno') }}" class="form-control" tabindex="2" autofocus>
                            @if ($errors->has('apellido_paterno'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('apellido_paterno') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dni">CI: </label>
                            <input type="text" name="dni" id="dni" min="0" value="{{ old('dni') }}"
                                class="form-control" tabindex="3">
                            @if ($errors->has('dni'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('dni') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono: </label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                                class="form-control" tabindex="4" onkeypress="return esNumero(event)">
                            @if ($errors->has('telefono'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('telefono') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="direccion">Dirección: </label>
                            <textarea name="direccion" id="direccion" class="form-control" tabindex="5"
                                placeholder="Direccón 255 caracteres">{{ old('direccion') }}</textarea>
                            @if ($errors->has('direccion'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('direccion') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="venta" value="1">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" tabindex="6">Registrar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal" tabindex="7">Cancel</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    {!! Html::style('select/dist/css/bootstrap-select.min.css') !!}

@stop


@section('js')
    {!! Html::script('select/dist/js/bootstrap-select.min.js') !!}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#agregar").click(function() {
                agregar();
            });
        });

        var cont = 1;
        total = 0;
        subtotal = [];
        $("#guardar").hide();
        $("#articulo_id").change(mostrarValores);

        function mostrarValores() {
            datosProducto = document.getElementById('articulo_id').value.split('_');

            $("#precio_venta").val(datosProducto[2]);
            $("#stock").val(datosProducto[1]);
        }

        // var articulo_id = $('#articulo_id');

        // articulo_id.change(function() {
        //     $.ajax({
        //         url: "{{ route('get_products_by_id') }}",
        //         method: 'GET',
        //         data: {
        //             articulo_id: articulo_id.val(),
        //         },
        //         success: function(data) {
        //             $("#precio_venta").val(data.precio_venta);
        //             $("#stock").val(data.stock);
        //             $("#codigo").val(data.codigo);
        //         }
        //     });
        // });
        // $(obtener_registro());

        // function obtener_registro(codigo) {
        //     $.ajax({
        //         url: "{{ route('get_products_by_barcode') }}",
        //         type: 'GET',
        //         data: {
        //             codigo: codigo
        //         },
        //         dataType: 'json',
        //         success: function(data) {
        //             $("#precio_venta").val(data.precio_venta);
        //             $("#stock").val(data.stock);
        //             $("#articulo_id").val(data.id);
        //         }
        //     });
        // }
        // $(document).on('keyup', '#codigo', function() {
        //     var valorResultado = $(this).val();
        //     if (valorResultado != "") {
        //         obtener_registro(valorResultado);
        //     } else {
        //         obtener_registro();
        //     }
        // })

        function agregar() {
            datosProducto = document.getElementById('articulo_id').value.split('_');
            articulo_id = datosProducto[0];

            articulo = $("#articulo_id option:selected").text();
            cantidad = $("#cantidad").val();
            descuento = $("#descuento").val();
            precio_venta = $("#precio_venta").val();
            stock = $("#stock").val();
            impuesto = $("#impuesto").val();
            if (articulo_id != "" && cantidad != "" && cantidad > 0 && descuento != "" && precio_venta != "") {
                if (parseInt(stock) >= parseInt(cantidad)) {
                    subtotal[cont] = (cantidad * precio_venta) - (cantidad * precio_venta * descuento / 100);
                    total = total + subtotal[cont];
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i></button></td> <td><input type="hidden" name="articulo_id[]" value="' +
                        articulo_id + '">' + articulo +
                        '</td> <td> <input type="hidden" name="precio_venta[]" value="' +
                        parseFloat(precio_venta).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(precio_venta).toFixed(2) +
                        '" disabled> </td> <td> <input type="hidden" name="descuento[]" value="' +
                        parseFloat(descuento) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(descuento) +
                        '" disabled> </td> <td> <input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"> <input type="number" value="' + cantidad +
                        '" class="form-control" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont])
                        .toFixed(
                            2) + '</td></tr>';
                    cont++;
                    limpiar();
                    totales();
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lo siento',
                        text: 'La cantidad a vender supera el stock.',
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'Rellene todos los campos del detalle de la venta.',
                })
            }
        }

        function limpiar() {
            $("#cantidad").val("");
            $("#descuento").val("0");
        }

        function totales() {
            $("#total").html("Bs " + total.toFixed(2));
            total_pagar = total;
            $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            total_pagar_html = total;
            $("#total").html("Bs" + total);
            $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
            $("#total_pagar").val(total_pagar_html.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
    </script>

@stop
