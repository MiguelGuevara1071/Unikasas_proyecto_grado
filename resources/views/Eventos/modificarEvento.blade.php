@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar evento</title>
        <link rel="stylesheet" href="{{ asset('css/Eventos/formularioCrearEvento.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="global">
        <div class="main">
            <div class="top">
                <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Modificar evento</h1>
            </div>
            <div class="formulario">
                <form action="{{ url('eventos/'.$evento->id) }}" method="post">
                    @csrf {{-- token de seguridad para el formulario  --}}

                    {{ method_field('PATCH') }}
                    <div class="contenedor-campos">
                        <h2><strong>Información general del evento</strong></h2>
                        <div class="campo">
                            <label for="eventName" style="padding-right: 2%">Nombre del evento:</label>
                            <div class="inputValidate">
                                <input type="text" placeholder="Nombre del evento..." id="eventName" name="nombre_evento" 
                                value="{{ isset($evento->nombre_evento)?$evento->nombre_evento:old('nombre_evento') }}" style="width: 98%;">
                                <span id="eventName_error_message" class="error_form"></span>
                            </div>
                        </div>
                        
                        <div class="campo">
                            <label for="eventDate" style="padding-right: 2%">Fecha:</label>
                            <div class="inputValidate">
                                <input type="date" class="campomedio" id="eventDate" name="fecha_evento"
                                value="{{ isset($evento->fecha_evento)?$evento->fecha_evento:old('fecha_evento') }}">
                                <span id="eventDate_error_message" class="error_form"></span>
                            </div>
                        </div>
                        
                        <div class="campo horario">
                                <label for="eventShedule1" style="padding-right: 8%;">Horario:</label>
                                <div class="inputValidate">
                                    <input type="time" class="hora" id="eventShedule1" name="hora_inicio"
                                    value="{{ date('h:i', strtotime($evento->hora_inicio)) }}">
                                    <span id="eventShedule1_error_message" class="error_form"></span>
                                </div>
                                    <label for="eventShedule2" class="horas" >Hasta:</label>
                                    <div class="inputValidate">
                                        <input type="time" class="address" id="eventShedule2" name="hora_fin"
                                        value="{{ date('h:i', strtotime($evento->hora_fin)) }}" style="width: 94%;">
                                        <span id="eventShedule2_error_message" class="error_form"></span>
                                </div>
                        </div>

                        <div class="campo">
                            <label for="eventProyect" style="padding-left: 14%;">Proyecto:</label>
                            <div class="inputValidate">
                                <select type="text" class="date" id="eventProyect" name="proyecto_id" style="width: 98%;">
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->id }} - {{ isset($proyecto->nombre_proyecto)?$proyecto->nombre_proyecto:old('nombre_proyecto') }}</option>
                                </select>
                                <span id="eventProyect_error_message" class="error_form"></span>
                            </div>

                            <label for="eventNotification">Notificación:</label>
                            <div class="inputValidate">
                                <select type="input" class="date" id="eventNotification" name="notificacion_evento" style="width: 100%;">
                                        <option>{{ isset($evento->notificacion_evento)?$evento->notificacion_evento:old('notificacion_evento') }}</option>
                                        <option value="5 minutos antes">5 minutos antes</option>
                                        <option value="10 minutos antes">10 minutos antes</option>
                                        <option value="20 minutos antes">20 minutos antes</option>
                                        <option value="30 minutos antes">30 minutos antes</option>
                                        <option value="40 minutos antes">40 minutos antes</option>
                                        <option value="50 minutos antes">50 minutos antes</option>
                                        <option value="1 hora antes">1 hora antes</option>
                                </select>
                                <span id="eventNotification_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <div class="campo">
                            <label for="eventPlace" style="padding-right: 3%">Lugar:</label>
                            <div class="inputValidate">
                                <input type="text" placeholder="Ingrese aqui el lugar del evento" id="eventPlace" name="lugar_evento" 
                                value="{{ isset($evento->lugar_evento)?$evento->lugar_evento:old('lugar_evento') }}" style="width: 98%;">
                                <span id="eventPlace_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <h2><strong>Información de los asistentes al evento</strong></h2>
                        <div class="campo">
                            <label for="eventAsisstant" style="padding-right: 3%;">Agregar invitados:</label>
                            <div class="inputValidate">
                                <p>Para agregar los invitados al evento en caso de ser mas de 1 invitado, agreguelos separados por una coma seguido de un espacio en blanco</p>
                                <input type="text" placeholder="Ingrese el correo de los invitados ejm: correo@mail.com" id="eventAsisstant" name="invitados_evento" 
                                value="{{ isset($evento->invitados_evento)?$evento->invitados_evento:old('invitados_evento') }}" style="width: 98%;">
                                <span id="eventAsisstant_error_message" class="error_form"></span>
                            </div>
                        </div>

                        {{-- <div class="campo campoCompartido">
                            <label for="invitados_evento"></label>
                            <textarea cols="120" rows="10" readonly>{{ isset($evento->invitados_evento)?$evento->invitados_evento:old('invitados_evento') }}</textarea>
                        </div> --}}
                        
                        <div class="campo campoCompartido">
                            <label for="eventBusiness" style="padding-left: 15%;">Asunto:</label>
                            <div class="inputValidate">
                                <textarea cols="120" rows="10" id="eventBusiness" name="asunto_evento" style="width: 99%;">{{ isset($evento->asunto_evento)?$evento->asunto_evento:old('asunto_evento') }}</textarea>
                                <span id="eventBusiness_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <div class="campo campoCompartido">
                            <label for="eventMessage" style="padding-left: 15%;">Mensaje:</label>
                            <div class="inputValidate">
                                <textarea cols="120" rows="10" id="eventMessage" name="mensaje_evento" style="width: 99%;">{{ isset($evento->mensaje_evento)?$evento->mensaje_evento:old('mensaje_evento') }}</textarea>
                                <span id="eventMenssage_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <input type="hidden" id="estado_evento" name="estado_evento" value="Activo">

                        <div class="botones" style="margin: 0 auto">
                            <input type="submit" value="CONFIRMAR" id="submit" disabled>
                            <a href="{{ url('eventos') }}">CANCELAR</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script type="text/javascript" src="{{ asset('js/Eventos/validateModifyEvent.js') }}"></script>
    </body>
    </html>
@endsection