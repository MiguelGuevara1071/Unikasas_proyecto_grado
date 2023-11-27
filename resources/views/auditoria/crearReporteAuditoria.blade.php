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
        <title>Crear reporte de Auditoria</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <div class="global">
        <main class="workspace">
            <div class="top">
                <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Crear reporte de Auditoria</h1>
            </div>
            <form class="searchForm" action="" method="get">
                @csrf
                <label class="search_parametros" for="itemSearch">Filtrar por / </label>
                <label class="search_parametros" for="itemSearch">Nombre del usuario:</label>
                    <select class="input-text" type="text" name="searchBar" id="searchBar">
                        <option value="null" selected disabled hidden>Seleccione el nombre del usuario</option>
                        @foreach ($auditoria as $audit )
                            <option value="{{ $audit->primer_nombre  }}">{{ $audit->primer_nombre }} {{ $audit->primer_apellido }}</option>
                        @endforeach
                    </select>

                <label class="search_parametros" for="fechaInicial">Fecha inicial:</label>
                <input type="date" id="fechaInicial" name="fechaInicial">Fecha final:
                <input type="date" id="fechaFinal" name="fechaFinal">


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
                                <label>Modulo:</label>
                                <input class="checkbox" type="checkbox" id="modulo" name="modulo" value="modulo">
                            </div>
                            <div class="campo">
                                <label>Tipo acción:</label>
                                <input class="checkbox" type="checkbox" id="tipoAccion" name="tipo_accion" value="tipo_accion">
                            </div>
                            <div class="campo">
                                <label>Item:</label>
                                <input class="checkbox" type="checkbox" id="item" name="item" value="item">
                            </div>
                            <div class="campo">
                                <label>Sub Item:</label>
                                <input class="checkbox" type="checkbox" id="subItem" name="sub_item" value="sub_item">
                            </div>
                            <div class="campo">
                                <label>Fecha:</label>
                                <input class="checkbox" type="checkbox" id="fechaAccion" name="fecha_accion" value="fecha_accion">
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
                    <a href="{{ url('/exportPdfAuditoria') }}" class="buttonPdf"><span>PDF</span></a>
                </div>
                <div>
                </div>
            </div>

            <div class="contenedor__imagen">
                <div class="container">

                    <table>
                        <?php $contador = 0; ?>
                        @foreach ($auditoria as $audit)
                        @if($contador == 0)
                        <tr>@if(isset($audit->id))
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
                            <tr>@if(isset($audit->id))
                                    <td>{{ $audit->id }}</td>
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
    </div>
    </body>
    </html>
@endsection
