@extends('layouts/layout')
@section('content')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/proyectos/moduloInicioProyecto.css') }}">
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+

        Icons"
        rel="stylesheet">
        <title>Proyectos Unikasas</title>
    </head>
    <body onload="calculateURL()">
        <div class="global">
            <h1 class="titleModule">Proyectos</h1>
            <form class="searchForm" action="{{ url('proyectos/search/activo') }}">
                <label>Buscar proyecto:</label>
                <input type="text" name="search" id="searchBar">
                <input type="submit" value="Buscar">
                <div class="filter">
                <input type="text" class="campomedio" list="encargado" placeholder="Filtrar por:" name="filtro">
                    <datalist id="encargado">
                        <option value="fecha_inicio">
                        <option value="estado_proyecto">
                    </datalist>
                </div>
            </form>
            <div class="container">
                <aside>
                    @if($isAdmin)
                    <div class="button">
                        <a class="buttonCreateProject" href="{{ url('/proyectos/create') }}">Crear proyecto</a>
                    </div>
                    @endif

                    <div class="button">
                        <a class="buttonArchived" value="activos" href="{{ url('/proyectos/search/inactivo') }}">Archivados</a>
                    </div>
                    @if($isAdmin)
                    <div class="button">
                        <a class="buttonCreateReport" href="{{ url('/reporteProyectos')}}">Crear reporte</a>
                    </div>
                    @endif
                </aside>
                <div class="proyectos">
                    @foreach ($proyectos as $proyecto)
                    <section>
                        <div class="contenedor">
                            <img src="{{ asset('storage/' .$proyecto->image) }}">
                            <div class="section__infoProyecto">
                                <h2 class="info">{{ $proyecto->nombre_proyecto }}</h2>
                                <h4 class="info">Encargado: <span>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</span></h4>
                                <h4 class="info">Cliente: <span>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</span></h4>
                                <h4 class="info">Fecha inicio: <span> {{ $proyecto->fecha_inicio }} </span></h4>
                                <h4 class="info">Estado: <span>{{ $proyecto->estado_proyecto }}</span></h4>
                            </div>
                            <a href="{{ url('proyectos/'.$proyecto->id) }}" class="button visualizar">Visualizar</a>
                        </div>
                    </section>
                    @endforeach
                    <div class="contenedorpaginacion">
                        <p class="parrafoPaginacion">{{ $proyectos->links() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/proyectos/inicio.js') }}"></script>
    </html>

@endsection
