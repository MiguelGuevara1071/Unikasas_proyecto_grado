@extends('layouts.layout')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/proyectos/viewProyecto.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Proyecto</title>
    </head>
    <body>
        @section('content')
        <div class="main">
            <div class="top">
                <a href="{{ url('/proyectos/search/activo') }}"><span class="material-icons back">arrow_back</span></a>
                @foreach($proyecto as $proyecto)
                    <h1>{{ $proyecto->nombre_proyecto }}</h1>
                @endforeach
            </div>
            <div class="contenedor">
                <aside>
                    @if($isAdmin)
                        @if($proyecto->estado_proyecto == "En ejecución")
                            <div class="button FinishProject">
                                <a class="textButton" type="button" href="#">Finalizar</a>
                            </div>
                            <div class="button SuspenderProject">
                                <a class="textButton" type="button" href="#">Suspender</a>
                            </div>
                        @elseif($proyecto->estado_proyecto == "Suspendido")
                            <div class="button FinishProject">
                                <a class="textButton" type="button" href="#">Finalizar</a>
                            </div>
                            <div class="button activate">
                                <a class="textButton" type="button" href="#">Activar</a>
                            </div>
                            <div class="button SuspenderProject" style="display: none;">
                                <a class="textButton" type="button" href="" style="display: none;">Suspender</a>
                            </div>
                        @endif
                    @endif
                </aside>
                <div class="proyecto">
                    <div class="infoGeneral">
                        <label>Encargado: <span>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</span></label>
                        <label>Cliente: <span>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</span></label>
                        <label>Fecha inicio: <span>{{ $proyecto->fecha_inicio }}</span></label>
                        <label>Ubicación: <span>{{ $proyecto->ciudad_proyecto }} - {{ $proyecto->direccion_proyecto }}</span></label>
                        <label>Costo estimado: <span>${{ $proyecto->costo_estimado }}</span></label>

                        @if($proyecto->estado_proyecto == "Suspendido")
                            <label>Estado: {{ $proyecto->estado_proyecto }}<span class="material-icons suspension">feed</span></label>
                        @else
                            <label>Estado: <span>{{ $proyecto->estado_proyecto }}</span></label>
                        @endif
                        <label>Producto: <span>{{ $proyecto->nombre_producto }}</span></label>
                        <label>Fecha final estimada: <span>{{ $proyecto->fecha_fin }}</span></label>
                        <label>Costo final: <span>${{ $proyecto->costo_final }}</span></label>
                        <label>Fecha final: <span>{{ $proyecto->fecha_fin }}</span></label>
                        @if($isAdmin)
                        @if($proyecto->estado_proyecto == "En ejecución")
                            <a id="link1" href="{{ url('/proyectos/' .$proyecto->id. '/edit') }}"><span class="material-icons edit-1">edit</span></a>

                            <a id="link2" href="{{ url('/proyectos/' .$proyecto->id. '/edit') }}"><span class="material-icons edit-1">edit</span></a>
                        @endif
                        @endif
                    </div>

                    <div class="contenedorFases">
                        <div class="capaFase">

                            @foreach($etapas as $etapa)
                            <div class="fase">
                                <h2>{{ $etapa->nombre_etapa }}</h2>
                                @foreach($actividades as $actividad)
                                    @if($actividad->etapa_id == $etapa->id)
                                        <div class="actividad">
                                            <h4>{{ $actividad->nombre_actividad }}</h4>
                                            <span>Fecha:  {{ $actividad->fecha_inicio }}</span>
                                            <span>Responsable: {{ $actividad->encargado_actividad }}</span>
                                            <div class="addDiv">
                                                <a href="{{ url('/actividades/' .$actividad->id) }}"><span class="material-icons view" value="{{ $myId = $actividad->id}}">visibility</span></a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="addDiv">
                                    @if($isAdmin)
                                    @if($proyecto->estado_proyecto == "En ejecución")
                                        <span class="material-icons add" value="{{ $etapa->id }}">add_circle</span>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- modales -->

            <section class="modal hidden">
                <div class="modal__content modalSuspender">
                    <div class="iconClose">
                        <span class="material-icons save">highlight_off</span>
                    </div>
                    <div class="modal__content--contenedor">
                        <form action="{{ url('proyectos/' .$proyecto->id) }}" method="post" id="formSuspender">
                            @csrf {{-- token de seguridad para el formulario  --}}
                            {{ method_field('PATCH') }}
                            <h2>Motivo de la suspensión</h2>
                                <textarea name="suspension_proyecto" id="" cols="60" rows="10" maxlength="200"></textarea>
                                <input type="text" value="suspension" name="accion" readonly style="display: none">
                                <input type="text" name="estado_proyecto" value="Suspendido" readonly style="display: none;">
                            <button class="save" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="modal hidden">
                <div class="modal__content createActivity editActivity">
                    <div class="iconClose">
                        <span class="material-icons save">highlight_off</span>
                    </div>
                    <div class="modal__content--contenedor">
                        <form action="{{ url('/actividades') }}" method="POST">
                            @csrf {{-- token de seguridad para el formulario  --}}
                            <input id="titleActivity" name="nombre_actividad" type="text" placeholder="Nombre de la actividad">
                            <div class="infoActividad">
                                <input type="text" value="" id="etapaId" name="etapa_id" style="display:none">
                                <div class="campo">
                                    <label>Encargado:</label>
                                    <input type="text" name="encargado_actividad">
                                </div>
                                <div class="campo">
                                    <label>Objetivo:</label>
                                    <textarea name="objetivo_actividad" id="" cols="40" rows="3" maxlength="100"></textarea>
                                </div>
                                <div class="campo">
                                    <label>Fecha inicio:</label>
                                    <input type="date" name="fecha_inicio">
                                </div>
                                <div class="campo">
                                    <label>Fecha fin:</label>
                                    <input type="date" name="fecha_fin">
                                </div>
                                <div class="campo">
                                    <label>Observaciones:</label>
                                    <textarea name="observaciones_actividad" id="" cols="40" rows="4"></textarea>
                                </div>
                                <div class="campo">
                                    <label>Estado:</label>
                                    <input type="text" name="estado_actividad" value="ejecucion" readonly>
                                </div>
                                <div class="botones">
                                    <input class="save" type="submit" value="Crear actividad" id="save"></input>
                                    <button class="save" type="button">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="modal hidden">
                <div class="modal__content finalizarProyecto">
                    <div class="iconClose">
                        <span class="material-icons save">highlight_off</span>
                    </div>
                    <div class="modal__content--contenedor">
                        <form action="{{ url('proyectos/' .$proyecto->id) }}" method="post">
                            @csrf {{-- token de seguridad para el formulario  --}}
                            {{ method_field('PATCH') }}
                            <h2>Finalizar proyecto</h2>
                            <span>¿Desea finalizar el proyecto?</span>
                            <input type="text" value="finalizacion" name="accion" readonly style="display: none">
                            <input type="text" name="estado_proyecto" value="Finalizado" readonly style="display: none;">
                            <div class="botones">
                                <button class="save" type="submit">Aceptar</button>
                                <button class="save" type="button">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="modal hidden">
                <div class="modal__content suspensionContent">
                    <div class="iconClose">
                        <span class="material-icons save">highlight_off</span>
                    </div>
                    <div class="modal__content--contenedor">
                        <h2>Motivo de la suspensión</h2>
                        @if($proyecto->suspension_proyecto != null)
                            <textarea cols="60" rows="10" readonly>{{ $proyecto->suspension_proyecto }}</textarea>
                        @else
                            <p>No hay motivo de la suspensión</p>
                        @endif
                        <button type="button" class="saveButton save">Aceptar</button>
                    </div>
                </div>
            </section>

            <section class="modal hidden">
                <div class="modal__content activeProject">
                    <div class="iconClose">
                        <span class="material-icons save">highlight_off</span>
                    </div>
                    <div class="modal__content--contenedor">
                        <h2>Activar proyecto</h2>
                        <span>¿Desea activar el proyecto?</span>
                        <form action="{{ url('proyectos/' .$proyecto->id) }}" method="post" id="activateForm">
                            @csrf {{-- token de seguridad para el formulario  --}}
                            {{ method_field('PATCH') }}
                            <input type="text" value="reactivacion" name="accion" readonly style="display: none">
                            <input type="text" value="En ejecución" name="estado_proyecto" readonly style="display: none;">
                        </form>
                        <div class="botones">
                            <button type="submit" class="saveButton" form="activateForm">Aceptar</button>
                            <button type="button" class="saveButton save">Cancelar</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <script src="{{ asset('js/proyectos/viewProyecto.js') }}"></script>
        @endsection

    </body>
    </html>
