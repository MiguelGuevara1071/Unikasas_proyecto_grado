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
        <title>Crear reporte de Productos</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <div class="global">
        <main class="workspace">
            <div class="top">
                <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Crear reporte de Productos</h1>
            </div>
            <form class="searchForm" action="" method="get">
                @csrf
                <label class="search_parametros" for="itemSearch">Filtrar por / </label>
                <label class="search_parametros" for="itemSearch">Nombre del producto:</label>
                    <select class="input-text" type="text" name="searchBar" id="searchBar">
                        <option value="null" selected disabled hidden>Seleccione el producto</option>
                         @foreach ($productos as $producto )
                            <option value="{{ $producto->nombre_producto }}">{{ $producto->nombre_producto }}</option>
                        @endforeach
                    </select>

                <label class="search_parametros" for="estado_Producto">Estado:</label>
                <select class="input-text" type="text" name="estado_Producto1" id="searchBar">
                    <option value="null" selected disabled hidden>Seleccione el estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Publicado">Publicado</option>
                </select>

                <label class="search_parametros" for="pisos_producto1">N. pisos:</label>
                <select class="input-text" type="text" name="pisos_producto1" id="searchBar">
                    <option value="null" selected disabled hidden>Seleccione el número</option>
                    <option value="1 piso">1 piso</option>
                    <option value="2 pisos">2 pisos</option>
                    <option value="3 pisos">3 pisos</option>
                    <option value="4 pisos">4 pisos</option>
                </select>


            <div class="container">
                    <div class="formulario">
                        @csrf
                        <h2 class="formulario__titulo">Seleccionar campos</h2>
                        <div class="contenedor-campos contenedor-campos2">
                            <div class="campo">
                                <label>Nombre:</label>
                                <input class="checkbox" type="checkbox" id="nombreProducto" name="nombre_producto" value="nombre_producto">
                            </div>
                            <div class="campo">
                                <label>Descripción:</label>
                                <input class="checkbox" type="checkbox" id="descripcionProducto" name="descripcion_producto" value="descripcion_producto">
                            </div>
                            <div class="campo">
                                <label>Precio:</label>
                                <input class="checkbox" type="checkbox" id="precioProducto" name="precio_producto" value="precio_producto">
                            </div>
                            <div class="campo">
                                <label>Tipo producto:</label>
                                <input class="checkbox" type="checkbox" id="tipoProducto" name="tipo_producto" value="tipo_producto">
                            </div>
                            <div class="campo">
                                <label>Material:</label>
                                <input class="checkbox" type="checkbox" id="materialProducto" name="material_producto" value="material_producto">
                            </div>
                            <div class="campo">
                                <label>Cantidad pisos:</label>
                                <input class="checkbox" type="checkbox" id="pisosProducto" name="pisos_producto" value="pisos_producto">
                            </div>
                            <div class="campo">
                                <label>Tamaño:</label>
                                <input class="checkbox" type="checkbox" id="tamañoProducto" name="tamaño_producto" value="tamaño_producto">
                            </div>
                            <div class="campo">
                                <label>N. Habitaciones:</label>
                                <input class="checkbox" type="checkbox" id="habitacionesProducto" name="habitaciones_producto" value="habitaciones_producto">
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input class="checkbox" type="checkbox" id="estadoProducto" name="estado_Producto" value="estado_Producto">
                            </div>
                        </div>

                        <div class="botones">
                            <input class="generar" type="submit" value="Generar">
                            <input class="cancelar" type="submit" value="Cancelar" src="{{ url('productos') }}">
                        </div>
                    </form>
            </div>

            <div class="previsualizacion">
                <div></div>
                <div>
                    <h2 class="titulo_previsualizacion">Previsualización</h2>
                </div>
                <div>
                    <a href="{{ url('/exportPdfProductos') }}" class="buttonPdf"><span>PDF</span></a>
                </div>
                <div>
                </div>
            </div>

            <div class="contenedor__imagen">
                <div class="container">

                    <table>
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
                                <th>N. Habitaciones </th>
                            @endif
                            @if(isset($producto->estado_Producto))
                                <th>Estado </th>
                            @endif
                        </tr>

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
