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
    <title>Reporte de Productos PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de Productos</h2>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    </thead>
                    <?php $contador = 0; ?>
                    @foreach ($productos as $producto)
                    @if($contador == 0)
                    <tr>@if(isset($producto->id))
                            <th>Id </th>
                        @endif
                        @if(isset($producto->nombre_producto))
                            <th>Nombre </th>
                        @endif
                        @if(isset($producto->descripcion_producto))
                            <th>Descripción </th>
                        @endif
                        @if(isset($producto->precio_producto))
                            <th>Precio </th>
                        @endif
                        @if(isset($producto->tipo_producto))
                            <th>Tipo producto </th>
                        @endif
                        @if(isset($producto->material_producto))
                            <th>Material </th>
                        @endif
                        @if(isset($producto->pisos_producto))
                            <th>Cantidad pisos </th>
                        @endif
                        @if(isset($producto->tamaño_producto))
                            <th>Tamaño </th>
                        @endif
                        @if(isset($producto->habitaciones_producto))
                            <th>Habitaciones </th>
                        @endif
                        @if(isset($producto->estado_Producto))
                            <th>Estado </th>
                        @endif
                        <?php $contador += 1; ?>
                    @endif
                    @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($productos as $producto)
                        <tr>@if(isset($producto->id))
                                <td>{{ $producto->id }}</td>
                            @endif
                            @if(isset($producto->nombre_producto))
                                <td>{{ $producto->nombre_producto }}</td>
                            @endif
                            @if(isset($producto->descripcion_producto))
                                <td>{{ $producto->descripcion_producto }}</td>
                            @endif
                            @if(isset($producto->precio_producto))
                                <td>{{ $producto->precio_producto }}</td>
                            @endif
                            @if(isset($producto->tipo_producto))
                                <td>{{ $producto->tipo_producto }}</td>
                            @endif
                            @if(isset($producto->material_producto))
                                <td>{{ $producto->material_producto }}</td>
                            @endif
                            @if(isset($producto->pisos_producto))
                                <td>{{ $producto->pisos_producto }}</td>
                            @endif
                            @if(isset($producto->tamaño_producto))
                                <td>{{ $producto->tamaño_producto }}</td>
                            @endif
                            @if(isset($producto->habitaciones_producto))
                                <td>{{ $producto->habitaciones_producto }}</td>
                            @endif
                            @if(isset($producto->estado_Producto))
                                <td>{{ $producto->estado_Producto }}</td>
                            @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>
</html>
