<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Nota de venta</title>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
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
        width: 25%;
        float: left;
        margin-top: 0px;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        border-radius: 5px;
        color: rgb(7, 7, 7);
        font-weight: bold;
    }

    .nota-venta {
        padding-left: 5px;
    }

    section {
        clear: left;
    }

    #cliente {
        text-align: left;
    }

    #facliente {
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

    #facliente thead {
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

    #proveedor {
        text-align: justify;
    }

    .datoscliente {
        float: left;
        width: 30%;
    }

    .datoscliente h3 {
        font-size: 15px;
    }

    #vendedor thead {
        padding: 20px;
        background: #33AFFF;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
        color:
    }

    #vendedor {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    section {
        margin-top: 10px;
    }

    .imagen {
        width: 40%;
        float: left;
        text-align: center;
    }

    .dato-empresa {
        margin-left: 30px;
        padding-left: 25px;
        text-align: left;
    }

    .footer {
        margin-top: auto;
        margin-bottom: 0px;
        position: sticky;
    }

    header {
        margin-top: 10px;
    }

</style>

<body>
    @for ($i = 1; $i <= 2; $i++)
        <header>
            <div class="datoscliente">
                <h3>DATOS DEL CLIENTE</h3>
                <p>
                    Cliente: {{ ucwords($venta->cliente->nombre) }}
                    {{ Str::ucfirst($venta->cliente->apellido_paterno) }}
                    {{ Str::ucfirst($venta->cliente->apellido_materno) }}<br>
                    Ci: {{ $venta->cliente->dni }}<br>
                    Teléfono: {{ $venta->cliente->telefono }} <br>
                    Dirección: {{ $venta->cliente->direccion }}
                </p>
            </div>
            <div id="fact">
                <p class="nota-venta">
                    NOTA DE VENTA
                    <br>
                    &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; {{ $venta->id }}
                </p>
            </div>
            <div class="imagen" width="200px">
                <img style="width: 200px;" src="imagen/logo-sumaj1.png" alt="logo-sumaj">
                {{-- <p class="dato-empresa">Call-Center: 800107772 <br>
                    Dirección: Av. Tomas de Lezo <br> entre C/Curuyuqui y Rio grande
                </p> --}}
                <p class="dato-empresa">Call-Center: 800101719 <br>
                    Dirección: Av. Edmundo Rodas <br> entre C/Medina y Jorochi
                </p>
            </div>
        </header>
        <br>
        <section>
            <table id="vendedor">
                <thead>
                    <tr id="fv">
                        <th align="left">FECHA DE VENTA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y H:i a') }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th align="left">CANTIDAD</th>
                            <th align="left">PRODUCTO</th>
                            <th align="left">PRECIO VENTA(Bs)</th>
                            <th align="right" colspan="2">SUBTOTAL(Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalleventas as $detalleventa)
                            <tr>
                                <td>{{ $detalleventa->cantidad }}</td>
                                <td>{{ Str::ucfirst($detalleventa->articulo->nombre) }}</td>
                                <td>Bs. {{ $detalleventa->precio_venta }}</td>
                                <td align="right" colspan="2">Bs.
                                    {{ number_format($detalleventa->cantidad * $detalleventa->precio_venta -($detalleventa->cantidad * $detalleventa->precio_venta * $detalleventa->descuento) / 100,2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <p align="right">TOTAL PAGAR: &nbsp; </p>
                            </th>
                            <td>
                                <p align="right">Bs. {{ number_format($venta->total, 2) }}</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
        <br><br><br>

        <footer class="footer">
            <!--puedes poner un mensaje aqui-->
            <div>
                <p>
                    <strong>NOTA </strong>: Una vez retirado su producto no se aceptan reclamos pasada las 24 Horas!!!

                </p>
            </div>
        </footer>
        <hr>
        <br><br><br>
    @endfor
</body>

</html>
