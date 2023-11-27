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
    <title>Reporte de Auditoria PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de Auditoria</h2>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    <?php $contador = 0; ?>
                    @foreach ($auditoria as $audit)
                    @if($contador == 0)
                    <tr>@if(isset($audit->user_id))
                            <th>Id </th>
                        @endif
                        @if(isset($audit->primer_nombre))
                            <th>Primer nombre </th>
                        @endif
                        @if(isset($audit->segundo_nombre))
                            <th>Segundo nombre </th>
                        @endif
                        @if(isset($audit->primer_apellido))
                            <th>Primer apellido </th>
                        @endif
                        @if(isset($audit->segundo_apellido))
                            <th>Segundo apellido </th>
                        @endif
                        @if(isset($audit->modulo))
                            <th>Modulo </th>
                        @endif
                        @if(isset($audit->tipo_accion))
                            <th>Tipo acción </th>
                        @endif
                        @if(isset($audit->item))
                            <th>Item </th>
                        @endif
                        @if(isset($audit->sub_item))
                            <th>Sub Item </th>
                        @endif
                        @if(isset($audit->fecha_accion))
                            <th>Fecha acción </th>
                        @endif
                        <?php $contador += 1; ?>
                    @endif
                    @endforeach
                    </tr>

                    @foreach ($auditoria as $audit)
                        <tr>@if(isset($audit->user_id))
                                <td>{{ $audit->user_id }}</td>
                            @endif
                            @if(isset($audit->primer_nombre))
                                <td>{{ $audit->primer_nombre }}</td>
                            @endif
                            @if(isset($audit->segundo_nombre))
                                <td>{{ $audit->segundo_nombre }}</td>
                            @endif
                            @if(isset($audit->primer_apellido))
                                <td>{{ $audit->primer_apellido }}</td>
                            @endif
                            @if(isset($audit->segundo_apellido))
                                <td>{{ $audit->segundo_apellido }}</td>
                            @endif
                            @if(isset($audit->modulo))
                                <td>{{ $audit->modulo }}</td>
                            @endif
                            @if(isset($audit->tipo_accion))
                                <td>{{ $audit->tipo_accion }}</td>
                            @endif
                            @if(isset($audit->item))
                                <td>{{ $audit->item }}</td>
                            @endif
                            @if(isset($audit->sub_item))
                                <td>{{ $audit->sub_item }}</td>
                            @endif
                            @if(isset($audit->fecha_accion))
                                <td>{{ $audit->fecha_accion }}</td>
                            @endif
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </main>
</body>
</html>
