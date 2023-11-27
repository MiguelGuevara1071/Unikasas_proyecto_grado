@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/Eventos/disponibilidadEvent.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Disponibilidad Eventos</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <main class="workspace">
            <div class="global">
            <div class="top">
                <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Ver disponibilidad</h1>
            </div>
                <header classs="enunciado_calendario headerCalendario">

                        <button class="boton" id="anterior" style="margin-right: 1%; width: 9%" onclick="mesantes()">&#60;</button>
                        <h2 id="titulos"></h2>
                        <button class="boton" id="posterior" style="width: 9%" onclick="mesdespues()">&#62;</button>

                        <h3 class="info">Fecha de hoy:</h3>
                        <span class="boton boton1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        {{-- <h3 class="info">Visualizar:</h3> --}}
                    <form action="" class="busqueda" method="get">
                        <input class="info" type="date" id="fecha" name="fecha" value="fecha">
                        <input class="info infoDos" type="date" id="fechaDos" name="fechaDos" value="fechaDos">
                        <input type="submit" value="BUSCAR"/>
                    </form>
                    {{-- <button class="boton boton2">&nbsp;</button>
                    <h3 class="info">Mas de 5 dias:</h3>
                    <button class="boton boton3">&nbsp;</button> --}}
                </header>
                <div class="grid">
                <div>
                <table id="diasc">

                    <tr id="fila0"><th class="dia calendario_dias"></th class="dia calendario_dias"><th class="dia calendario_dias"></th><th class="dia calendario_dias"></th><th class="dia calendario_dias"></th><th class="dia calendario_dias"></th><th class="dia calendario_dias"></th><th class="dia calendario_dias"></th class="dia calendario_dias borderuno"></tr>
                    <tr id="fila1"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                    <tr id="fila2"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                    <tr id="fila3"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                    <tr id="fila4"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                    <tr id="fila5"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                    <tr id="fila6"><td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td>
                                    <td><a href="{{ url('eventos/create')}}"><p></p></a></td></tr>
                <tr style="border: none"><td colspan="7">
                <div id="fechaactual" class="fechaactual"><i onclick="actualizar()">HOY:&nbsp;&nbsp;</i></div>
                <div id="buscafecha">
                    <form action="#" name="buscar" class="buscarMes">
                    <span>Buscar por mes:
                        <select name="buscames" style="width: 20%">
                        <option value="0">Enero</option>
                        <option value="1">Febrero</option>
                        <option value="2">Marzo</option>
                        <option value="3">Abril</option>
                        <option value="4">Mayo</option>
                        <option value="5">Junio</option>
                        <option value="6">Julio</option>
                        <option value="7">Agosto</option>
                        <option value="8">Septiembre</option>
                        <option value="9">Octubre</option>
                        <option value="10">Noviembre</option>
                        <option value="11">Diciembre</option>
                        </select>
                        Buscar año:
                        <input type="text" name="buscaanno" maxlength="4" size="4" />
                        <input type="button" value="BUSCAR" onclick="mifecha()" />
                    </span>
                    </form>
                </tr></td>

                </div>
                </table>
                </div>
                <div class="resultados">
                    <h3 class="info">Resultados de busqueda</h3>
                    @foreach ($eventos as $evento)
                        <a class="eventoInfo" href="{{ url('eventos/'.$evento->id)}}"><p class="eventoDia"><b> Fecha: </b> {{ date('d/m/Y', strtotime($evento->fecha_evento)) }} <b> Desde: </b>{{ date('h:i A', strtotime($evento->hora_inicio)) }} <b> Hasta: </b> {{ date('h:i A', strtotime($evento->hora_fin))}}</p></a>
                    @endforeach
                    {{-- <p>{{ $eventos->links() }}</p> --}}
                </div> 
                </div>
                
        </main>
    </div>
        <script type="text/javascript" src="{{ asset('js/Eventos/calendario.js')}}"></script>
    </body>
    </html>
@endsection
