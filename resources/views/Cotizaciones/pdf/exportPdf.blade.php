<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('css/Eventos/cearReporteEventos.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    <style>
    html{
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    h2{
        margin: 2% auto;
        text-align: center;
        justify-content: center;
        align-content: center;
    }

    table{
        border-collapse: collapse;
        border: none;
        width: 100%;
        margin-left: 1%;
    }

    th {
        border: 1px solid #000000;
        margin: 0%;
        width: auto;
        background-color: #ffa500;
        font-weight: lighter;
    }

    td {
        border: 1px solid #000000;
        padding-bottom: 0%;
        text-align: center;
        padding-top: 0%;
        height: 2px;
        background-color: #ffffff;
        font-weight: lighter;
    }
    </style>
    <title>Reporte de Cotizaciones PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de Cotizaciones</h2>
        <div class="contenedor__imagen">
            <div class="container">
             
                <table>
                    <thead>
                        <tr>
                        <?php $contador = 0; ?>
                        @foreach ($cotizaciones as $cotizacion)
                        @if($contador == 0)
                                @if(isset($cotizacion->id))
                                    <th>Id </th>
                                @endif
                                @if(isset($cotizacion->nombres_cotizante))
                                    <th>Nombres cotizante </th>
                                @endif
                                @if(isset($cotizacion->apellidos_cotizante))
                                    <th>Apellidos cotizante </th>
                                @endif
                                @if(isset($cotizacion->email_cotizante))
                                    <th>Email </th>
                                @endif
                                @if(isset($cotizacion->telefono_cotizante))
                                    <th>Telefono </th>
                                @endif
                                @if(isset($cotizacion->ciudad_cotizante))
                                    <th>Ciudad </th>
                                @endif
                                @if(isset($cotizacion->ubicacion_cotizante))
                                    <th>Ubicación </th>
                                @endif
                                @if(isset($cotizacion->fecha_cotizacion))
                                    <th>Fecha </th>
                                @endif
                                @if(isset($cotizacion->comentarios_cotizacion))
                                    <th>Comentarios </th>
                                @endif
                                @if(isset($cotizacion->estado_cotizacion))
                                    <th>Estado </th>
                                @endif
                                @if(isset($cotizacion->nombre_producto))
                                    <th>Producto </th>
                                @endif
                                    <?php $contador += 1; ?>
                            @endif

                        @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($cotizaciones as $cotizacion)
                        <tr>@if(isset($cotizacion->id))
                                <td>{{ $cotizacion->id }}</td>
                            @endif
                            @if(isset($cotizacion->nombres_cotizante))
                                <td>{{ $cotizacion->nombres_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->apellidos_cotizante))
                                <td>{{ $cotizacion->apellidos_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->email_cotizante))
                                <td>{{ $cotizacion->email_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->telefono_cotizante))
                                <td>{{ $cotizacion->telefono_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->ciudad_cotizante))
                                <td>{{ $cotizacion->ciudad_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->ubicacion_cotizante))
                                <td>{{ $cotizacion->ubicacion_cotizante }}</td>
                            @endif
                            @if(isset($cotizacion->fecha_cotizacion))
                                <td>{{ date('d/m/Y', strtotime($cotizacion->fecha_cotizacion)) }}</td>
                            @endif
                            @if(isset($cotizacion->comentarios_cotizacion))
                                <td>{{ $cotizacion->comentarios_cotizacion }}</td>
                            @endif
                            @if(isset($cotizacion->estado_cotizacion))
                                <td>{{ $cotizacion->estado_cotizacion }}</td>
                            @endif
                            @if(isset($cotizacion->nombre_producto))
                                <td>{{ $cotizacion->nombre_producto }}</td>
                            @endif

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>
</html>