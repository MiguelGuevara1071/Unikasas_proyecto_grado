@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/Eventos/moduloEvent.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Proyectos Unikasas Eventos</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <main class="workspace">
            <div class="global">
            <h1 class="titleModule">Eventos</h1>
            <form class="searchForm" action="">
                <label for="itemSearch">Buscar evento:</label>
                <input type="text" placeholder="Escriba el dato a buscar en el evento" name="searchBar" id="searchBar">
                <input type="submit" value="Buscar">
                <div class="filter">
                    <select type="text" class="campomedio" id="campoBusqueda" name="campoBusqueda">
                            <option value="null" selected disabled hidden>Filtrar por:</option>
                            <option value="nombre_evento">Nombre del evento</option>
                            <option value="invitados_evento">Invitados del evento</option>
                            <option value="lugar_evento">Lugar del evento</option>
                            <option value="estado_evento">Estado.Activ-Cancel-Final</option>
                    </select>
                </div>
            </form>
            <div class="container">
                <aside>
                    @if($isAdmin)
                    <div class="button">
                        <a class="buttonCreateEvento" href="{{ url('eventos/create') }}">Crear evento</a>
                    </div>
                    @endif
                    {{-- <div class="button">
                        <a class="buttonDisponibilidad" href="{{ url('/disponibilidad') }}">Disponibilidad</a>
                    </div> --}}
                    <div class="button">
                        <a class="buttonDisponibilidad" href="{{ url('/verDisponibilidad') }}">Disponibilidad</a>
                    </div>
                    @if($isAdmin)
                    <div class="button">
                        <a class="buttonCreateReporte" href="{{ url('/reporteEventos') }}">Crear reporte</a>
                    </div>
                    @endif
                </aside>

                <main class="eventos">
                    @if(Session::has('mensaje'))
                        <p style="text-align: center; margin: 0.5%">{{ Session::get('mensaje') }}</p>
                    @endif
                    @foreach ($eventos as $evento)

                    <section>
                        <div class="contenedor">
                                <div class="contenedor-secundario">
                                    <time class="dia">{{ date('d', strtotime($evento->fecha_evento)) }}</time>
                                    <time class="fecha">{{ date('m - Y', strtotime($evento->fecha_evento)) }}</time>
                                    <time class="hora">{{ date('h:i', strtotime($evento->hora_inicio)) }} {{' - '.date('h:i A', strtotime($evento->hora_fin)) }}</time>
                                </div>
                                <div class="section__infoEvento">
                                    <h2 class="info responsive">Nombre evento: <span>{{ $evento->nombre_evento }}</span></h2>
                                    <h4 class="info">Lugar: <span>{{ $evento->lugar_evento }}</span></h4>
                                    <h4 class="info">Asistentes: <span>{{ $evento->invitados_evento }}</span></h4>
                                    <h4 class="info">Proyecto: <span>{{ $evento->nombre_proyecto }}</span></h4>
                                </div>
                            <a href="{{ url('eventos/'.$evento->id) }}" class="button visualizar">Visualizar</a>
                        </div>
                    </section>

                    @endforeach

                    <p>{{ $eventos->links() }}</p>

                    </div>
                </main>
            </div>

        </main>
    </div>
    </body>
    </html>
@endsection
