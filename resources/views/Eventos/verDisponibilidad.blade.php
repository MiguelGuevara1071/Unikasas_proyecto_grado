@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script src="{{ asset('js/Eventos/disponibilidad.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/Eventos/disponibilidad.css') }}">
        <title>Visualizar disponibilidad</title>
    </head>
    <body>
        <main class="workspace">
            <div class="global">
            <div class="top">
                <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Ver disponibilidad</h1>
            </div>
            <div>
                <div style="display: inline-flex; width: 50%">
                    <h3 class="info">Fecha de hoy:</h3>
                    <span class="boton boton1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <h3 class="info">Dia seleccionado:</h3>
                    <span class="boton boton2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
                <div class="grid">
                        <div id="datepicker" style="margin: 0 auto"></div>
                        
                            <div style="width: 95%; margin: 0 auto">
                            <form action="" id="form">
                                <span class="labelFecha">Fecha:</span><input type="text" id="text" name="fecha" value="" placeholder="Ingrese MM/DD/AAAA"/>
                                <input type="submit" value="Buscar">
                            </form>
                            {{-- </div> --}}
                            <div class="resultados" style="width: 85%; margin: 0 auto">
                                <h3 class="info">Resultados de busqueda del dia seleccionado</h3>
                                @if(isset($eventos))
                                    @forelse ($eventos as $evento)
                                        <a class="eventoInfo" href="{{ url('eventos/'.$evento->id)}}"><p class="eventoDia"><b> Fecha: </b> {{ date('d/m/Y', strtotime($evento->fecha_evento)) }} <b> Desde: </b>{{ date('h:i A', strtotime($evento->hora_inicio)) }} <b> Hasta: </b> {{ date('h:i A', strtotime($evento->hora_fin))}}</p></a>
                                    @empty
                                        <h4>No existen eventos para el dia seleccionado</h4>
                                    @endforelse    
                                @endif
                        
                                @if(isset($eventosMes))
                                    <h3 class="info">Eventos existentes para el mes</h3>
                                    @forelse ($eventosMes as $evento)
                                        <a class="eventoInfo" href="{{ url('eventos/'.$evento->id)}}"><p class="eventoDia"><b> Fecha: </b> {{ date('d/m/Y', strtotime($evento->fecha_evento)) }} <b> Desde: </b>{{ date('h:i A', strtotime($evento->hora_inicio)) }} <b> Hasta: </b> {{ date('h:i A', strtotime($evento->hora_fin))}}</p></a>
                                    @empty
                                        <h4>No hay eventos existentes para el mes</h4>
                                    @endforelse   
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>
@endsection