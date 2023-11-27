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
    <title>Reporte de Usuarios PDF</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h2>Reporte de Usuarios</h2>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    </thead>
                    <?php $contador = 0; ?>
                    @foreach ($usuarios as $usuario)
                    @if($contador == 0)
                    <tr>@if(isset($usuario->id))
                        <th>Id </th>
                    @endif
                    @if(isset($usuario->primer_nombre))
                        <th>Primer nombre </th>
                    @endif
                    @if(isset($usuario->segundo_nombre))
                        <th>Segundo nombre </th>
                    @endif
                    @if(isset($usuario->primer_apellido))
                        <th>Primer apellido </th>
                    @endif
                    @if(isset($usuario->segundo_apellido))
                        <th>Segundo apellido </th>
                    @endif
                    @if(isset($usuario->tipo_documento))
                        <th>Tipo documento </th>
                    @endif
                    @if(isset($usuario->numero_documento))
                        <th>Número documento </th>
                    @endif
                    @if(isset($usuario->telefono_usuario))
                        <th>Telefono </th>
                    @endif
                    @if(isset($usuario->email))
                        <th>Email </th>
                    @endif
                    @if(isset($usuario->estado_usuario))
                        <th>Estado </th>
                    @endif
                    @if(isset($usuario->nombre_rol))
                        <th>Rol </th>
                    @endif
                        <?php $contador += 1; ?>
                        @endif
                    @endforeach
                    </tr>
                    </thead>

                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>@if(isset($usuario->id))
                                <td>{{ $usuario->id }}</td>
                            @endif
                            @if(isset($usuario->primer_nombre))
                                <td>{{ $usuario->primer_nombre }}</td>
                            @endif
                            @if(isset($usuario->segundo_nombre))
                                <td>{{ $usuario->segundo_nombre }}</td>
                            @endif
                            @if(isset($usuario->primer_apellido))
                                <td>{{ $usuario->primer_apellido }}</td>
                            @endif
                            @if(isset($usuario->segundo_apellido))
                                <td>{{ $usuario->segundo_apellido }}</td>
                            @endif
                            @if(isset($usuario->tipo_documento))
                                <td>{{ $usuario->tipo_documento }}</td>
                            @endif
                            @if(isset($usuario->numero_documento))
                                <td>{{ $usuario->numero_documento }}</td>
                            @endif
                            @if(isset($usuario->telefono_usuario))
                                <td>{{ $usuario->telefono_usuario }}</td>
                            @endif
                            @if(isset($usuario->email))
                                <td>{{ $usuario->email }}</td>
                            @endif
                            @if(isset($usuario->estado_usuario))
                                <td>{{ $usuario->estado_usuario }}</td>
                            @endif
                            @if(isset($usuario->nombre_rol))
                                <td>{{ $usuario->nombre_rol }}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>
</html>
