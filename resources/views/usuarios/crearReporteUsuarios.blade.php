@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/proyectos/cearReporteProyectos.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Crear reporte de Usuarios</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <div class="global">
        <main class="workspace">
            <div class="top">
                <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Crear reporte de Usuarios</h1>
            </div>
            <form class="searchForm" action="" method="get">
                @csrf
                <label class="search_parametros" for="itemSearch">Filtrar por / </label>
                <label class="search_parametros" for="itemSearch">Nombre del usuario:</label>
                    <select class="input-text" type="text" name="searchBar" id="searchBar">
                        <option value="null" selected disabled hidden>Seleccione el nombre del usuario</option>
                        @foreach ($usuarios as $usuario )
                            <option value="{{ $usuario->primer_nombre  }}">{{ $usuario->primer_nombre }} {{ $usuario->primer_apellido }}</option>
                        @endforeach
                    </select>

                <label class="search_parametros" for="estado_usuario1">Estado:</label>
                <select class="input-text" type="text" name="estado_usuario1" id="searchBar">
                    <option value="null" selected disabled hidden>Seleccione el estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

                <label class="search_parametros" for="nombre_rol1">Rol:</label>
                <select class="input-text" type="text" name="nombre_rol1" id="searchBar">
                    <option value="null" selected disabled hidden>Seleccione el rol</option>
                    @foreach ($roles as $rol )
                        <option value="{{ $rol->nombre_rol  }}">{{ $rol->nombre_rol }}</option>
                    @endforeach
                </select>

            <div class="container">
                    <div class="formulario">
                        @csrf
                        <h2 class="formulario__titulo">Seleccionar campos</h2>
                        <div class="contenedor-campos contenedor-campos2">
                            <div class="campo">
                                <label>Primer nombre:</label>
                                <input class="checkbox" type="checkbox" id="primerNombre" name="primer_nombre" value="primer_nombre">
                            </div>
                            <div class="campo">
                                <label>Segundo nombre:</label>
                                <input class="checkbox" type="checkbox" id="segundoNombre" name="segundo_nombre" value="segundo_nombre">
                            </div>
                            <div class="campo">
                                <label>Primer apellido:</label>
                                <input class="checkbox" type="checkbox" id="primerApellido" name="primer_apellido" value="primer_apellido">
                            </div>
                            <div class="campo">
                                <label>Segundo apellido:</label>
                                <input class="checkbox" type="checkbox" id="segundoApellido" name="segundo_apellido" value="segundo_apellido">
                            </div>
                            <div class="campo">
                                <label>Tipo documento:</label>
                                <input class="checkbox" type="checkbox" id="tipoDocumento" name="tipo_documento" value="tipo_documento">
                            </div>
                            <div class="campo">
                                <label>Número documento:</label>
                                <input class="checkbox" type="checkbox" id="numeroDocumento" name="numero_documento" value="numero_documento">
                            </div>
                            <div class="campo">
                                <label>Telefono:</label>
                                <input class="checkbox" type="checkbox" id="telefonoUsuario" name="telefono_usuario" value="telefono_usuario">
                            </div>
                            <div class="campo">
                                <label>Email:</label>
                                <input class="checkbox" type="checkbox" id="email" name="email" value="email">
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input class="checkbox" type="checkbox" id="estadoUsuario" name="estado_usuario" value="estado_usuario">
                            </div>
                            <div class="campo">
                                <label>Rol:</label>
                                <input class="checkbox" type="checkbox" id="nombreRol" name="nombre_rol" value="nombre_rol">
                            </div>
                        </div>

                        <div class="botones">
                            <input class="generar" type="submit" value="Generar">
                            <input class="cancelar" type="submit" value="Cancelar" src="{{ url('proyectos') }}">
                        </div>
                    </form>
            </div>

            <div class="previsualizacion">
                <div></div>
                <div>
                    <h2 class="titulo_previsualizacion">Previsualización</h2>
                </div>
                <div>
                    <a href="{{ url('/exportPdfUsuarios') }}" class="buttonPdf"><span>PDF</span></a>
                </div>
                <div>
                </div>
            </div>

            <div class="contenedor__imagen">
                <div class="container">

                    <table>
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
                        </tr>

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
                    </table>
                </div>
            </div>
        </main>
    </div>
    </body>
    </html>
@endsection
