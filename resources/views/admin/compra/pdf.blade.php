<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Reporte de compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .datosproveedor {
            float: left;
            width: 30%;
        }

        .datosproveedor h3 {
            font-size: 15px;
        }

        #datos {
            float: left;
            margin-top: 0%;
            margin-left: 2%;
            margin-right: 2%;
        }

        #encabezado {
            text-align: center;
            margin-left: 35%;
            margin-right: 35%;
            font-size: 15px;
        }

        #fact {
            width: 27%;
            float: left;
            margin-top: 0px;
            margin-left: 2%;
            margin-right: 2%;
            font-size: 20px;
            border-radius: 5px;
            color: rgb(7, 7, 7);
            font-weight: bold;
        }

        #cliente {
            text-align: left;
        }

        #faproveedor {
            width: 40%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 15px;
        }

        #fac,
        #fv,
        #fa {
            color: #FFFFFF;
            font-size: 15px;
        }

        #faproveedor thead {
            padding: 20px;
            background: #33AFFF;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }

        #proveedor {
            text-align: justify;
        }

        #faccomprador {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        #faccomprador thead {
            padding: 20px;
            background: #33AFFF;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }

        #facproducto {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 15px;
        }

        #facproducto thead {
            padding: 20px;
            background: #33AFFF;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        .section-comprador {
            margin-top: 160px;
        }

        .imagen {
            width: 40%;
            float: left;
            text-align: center;
        }

        .dato-empresa {
            /* width: 100%; */
            margin-left: 30px;
            padding-left: 25px;
            text-align: left;
            font-size: 15px;
        }

        .footer {
            margin-top: auto;
            margin-bottom: 0px;
            position: sticky;
        }

        .nota-compra {
            padding-left: 5px;
        }

    </style>
</head>

<body>
    @for ($i = 1; $i <= 2; $i++)
        <header>
            <div class="datosproveedor">
                <h3>DATOS DEL PROVEEDOR</h3>
                <p id="proveedor">Nombre: {{ ucwords($compra->proveedor->razon_social) }}<br>
                    Nit: {{ $compra->proveedor->nit }}<br>
                    Teléfono: {{ $compra->proveedor->telefono }}<br>
                    Email: {{ $compra->proveedor->email }}<br>
                    Dirección: {{ ucwords($compra->proveedor->direccion) }}
                </p>
            </div>
            <div id="fact">
                <p class="nota-compra">
                    NOTA DE COMPRA
                    <br>
                    &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; {{ $compra->id }}
                </p>
            </div>
            <div class="imagen" width="200px;">
                <img style="width: 200px;" src="imagen/logo-sumaj1.png" alt="logo-sumaj">
                <p class="dato-empresa">Call-Center: 800107772 <br>
                    Dirección: Av. Tomas de Lezo <br> entre C/Curuyuqui y Rio grande
                </p>
            </div>
        </header>
        <br>
        <section class="section-comprador">
            <table id="faccomprador">
                <thead>
                    <tr id="fv">
                        <th align="left">COMPRADOR</th>
                        <th align="left">FECHA DE COMPRA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ ucwords($compra->user->name) }}</td>
                        <td>{{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d-m-Y H:i a') }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <br>
        <section>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th align="left">CANTIDAD</th>
                        <th align="left">PRODUCTO</th>
                        <th align="left">PRECIO COMPRA (Bs)</th>
                        <th align="right" colspan="2">SUBTOTAL (Bs)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detallecompras as $detallecompra)
                        <tr>
                            <td>{{ $detallecompra->cantidad }}</td>
                            <td>{{ ucwords($detallecompra->articulo->nombre) }}</td>
                            <td>Bs. {{ $detallecompra->precio_compra }}</td>
                            <td align="right" colspan="2">Bs.
                                {{ number_format($detallecompra->cantidad * $detallecompra->precio_compra, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <p align="right">TOTAL PAGAR: &nbsp;</p>
                        </th>
                        <td>
                            <p align="right">Bs. {{ number_format($compra->total, 2) }}
                            <p>
                        </td>
                    </tr>

                </tfoot>
            </table>
        </section>
        <br><br><br><br>
        <footer>
            <!--se puede poner un mensaje aqui-->
            <div>
                <p>
                    {{-- <b>{{$company->name}}</b><br>{{$company->description}}<br>Telefono:{{$company->telephone}}<br>Email:{{$company->email}} --}}
                </p>
            </div>
        </footer>
        <hr>
    @endfor
</body>

</html>
