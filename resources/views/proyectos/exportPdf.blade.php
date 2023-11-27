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
    <title>Reporte de Proyectos PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de Proyectos</h2>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    </thead>
                    <?php $contador = 0; ?>
                    @foreach ($proyectos as $proyecto)
                    @if($contador == 0)
                    <tr>@if(isset($proyecto->id))
                                <th>Id </th>
                            @endif
                            @if(isset($proyecto->nombre_proyecto))
                                <th>Nombre </th>
                            @endif
                            @if(isset($proyecto->estado_proyecto))
                                <th>Estado </th>
                            @endif
                            @if(isset($proyecto->fecha_inicio))
                                <th>Fecha inicial </th>
                            @endif
                            @if(isset($proyecto->fecha_fin))
                                <th>Fecha final </th>
                            @endif
                            @if(isset($proyecto->ciudad_proyecto))
                                <th>Ciudad proyecto </th>
                            @endif
                            @if(isset($proyecto->direccion_proyecto))
                                <th>Direccion proyecto </th>
                            @endif
                            @if(isset($proyecto->costo_estimado))
                                <th>Costo estimado </th>
                            @endif
                            @if(isset($proyecto->costo_final))
                                <th>Costo final </th>
                            @endif
                            @if(isset($proyecto->nombre_producto))
                                <th>Nombre producto </th>
                            @endif
                            @if(isset($proyecto->encargado_nombre))
                                <th>Nombre encargado </th>
                            @endif
                            @if(isset($proyecto->cliente_nombre))
                                <th>Nombre cliente </th>
                            @endif
                        <?php $contador += 1; ?>
                        @endif
                    @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>@if(isset($proyecto->id))
                                <td>{{ $proyecto->id }}</td>
                            @endif
                            @if(isset($proyecto->nombre_proyecto))
                                <td>{{ $proyecto->nombre_proyecto }}</td>
                            @endif
                            @if(isset($proyecto->estado_proyecto))
                                <td>{{ $proyecto->estado_proyecto }}</td>
                            @endif
                            @if(isset($proyecto->fecha_inicio))
                                <td>{{ $proyecto->fecha_inicio }}</td>
                            @endif
                            @if(isset($proyecto->fecha_fin))
                                <td>{{ $proyecto->fecha_fin }}</td>
                            @endif
                            @if(isset($proyecto->ciudad_proyecto))
                                <td>{{ $proyecto->ciudad_proyecto }}</td>
                            @endif
                            @if(isset($proyecto->direccion_proyecto))
                                <td>{{ $proyecto->direccion_proyecto }}</td>
                            @endif
                            @if(isset($proyecto->costo_estimado))
                                <td>{{ $proyecto->costo_estimado }}</td>
                            @endif
                            @if(isset($proyecto->costo_final))
                                <td>{{ $proyecto->costo_final }}</td>
                            @endif
                            @if(isset($proyecto->nombre_producto))
                                <td>{{ $proyecto->nombre_producto }}</td>
                            @endif
                            @if(isset($proyecto->encargado_nombre))
                                <td>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</td>
                            @endif
                            @if(isset($proyecto->cliente_nombre))
                                <td>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</td>
                            @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>
</html>
