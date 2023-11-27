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
    <title>Reporte de Eventos PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de eventos</h2>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    <thead>
                        <tr>
                        <?php $contador = 0; ?>
                        @foreach ($eventos as $evento)
                        @if($contador == 0)
                                @if(isset($evento->id))
                                    <th>Id </th>
                                @endif
                                @if(isset($evento->nombre_evento))
                                    <th>Nombre </th>
                                @endif
                                @if(isset($evento->fecha_evento))
                                    <th>Fecha </th>
                                @endif
                                @if(isset($evento->hora_inicio))
                                    <th>Hora inicial </th>
                                @endif
                                @if(isset($evento->hora_fin))
                                    <th>Hora final </th>
                                @endif
                                @if(isset($evento->nombre_proyecto))
                                    <th>Proyecto </th>
                                @endif
                                @if(isset($evento->notificacion_evento))
                                    <th>Notificación </th>
                                @endif
                                @if(isset($evento->invitados_evento))
                                    <th>Invitados </th>
                                @endif
                                @if(isset($evento->lugar_evento))
                                    <th>Lugar </th>
                                @endif
                                @if(isset($evento->asunto_evento))
                                    <th>Asunto </th>
                                @endif
                                @if(isset($evento->mensaje_evento))
                                    <th>Mensaje </th>
                                @endif
                                @if(isset($evento->estado_evento))
                                    <th>Estado </th>
                                @endif
                                    <?php $contador += 1; ?>
                            @endif

                        @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($eventos as $evento)
                        <tr>@if(isset($evento->id))
                                <td>{{ $evento->id }}</td>
                            @endif
                            @if(isset($evento->nombre_evento))
                                <td>{{ $evento->nombre_evento }}</td>
                            @endif
                            @if(isset($evento->fecha_evento ))
                                <td>{{ date('d/m/Y', strtotime($evento->fecha_evento))}}</td>
                            @endif
                            @if(isset($evento->hora_inicio))
                                <td>{{ date('h:i A', strtotime($evento->hora_inicio)) }}</td>
                            @endif
                            @if(isset($evento->hora_fin))
                                <td>{{ date('h:i A', strtotime($evento->hora_fin)) }}</td>
                            @endif
                            @if(isset($evento->nombre_proyecto))
                                <td>{{ $evento->nombre_proyecto }}</td>
                            @endif
                            @if(isset($evento->notificacion_evento))
                                <td>{{ $evento->notificacion_evento }}</td>
                            @endif
                            @if(isset($evento->invitados_evento))
                                <td>{{ $evento->invitados_evento }}</td>
                            @endif
                            @if(isset($evento->lugar_evento))
                                <td>{{ $evento->lugar_evento }}</td>
                            @endif
                            @if(isset($evento->asunto_evento))
                                <td>{{ $evento->asunto_evento }}</td>
                            @endif
                            @if(isset($evento->mensaje_evento))
                                <td>{{ $evento->mensaje_evento }}</td>
                            @endif
                            @if(isset($evento->estado_evento))
                                <td>{{ $evento->estado_evento }}</td></tr>
                            @endif

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>
</html>
