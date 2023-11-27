@extends('layouts.layout')
@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/proyectos/editProyecto.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Proyecto</title>
    </head>
    <body>
        <div class="main">
            <div class="top">
                <a href="{{ url('/proyectos/search/activo') }}"><span class="material-icons back">arrow_back</span></a>
                @foreach($proyecto as $proyecto)
                    <h1>{{ $proyecto->nombre_proyecto }}</h1>
                @endforeach
            </div>


            <div class="contenedor">
                <aside>
                    <div class="button save">
                        <button class="textButton saveButton" type="submit" form="formEdit" onclick="history.back()">Guardar</button>
                    </div>
                    <div class="button cancel">
                        <a class="textButton cancelButton" onclick="history.back()">Cancelar</a>
                    </div>
                </aside>
                <div class="proyecto">
                    <div class="infoGeneral">
                    <label>Encargado: <span>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</span></label>
                        <label>Cliente: <span>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</span></label>
                        <label>Fecha inicio: <span>{{ $proyecto->fecha_inicio }}</span></label>
                        <label>Ubicación: <span>{{ $proyecto->ciudad_proyecto }} - {{ $proyecto->direccion_proyecto }}</span></label>
                        <label>Costo estimado: <span>${{ $proyecto->costo_estimado }}</span></label>
                        <label>Estado: <span>{{ $proyecto->estado_proyecto }}</span></label>
                        <label>Producto: <span>{{ $proyecto->nombre_producto }}</span></label>
                        <label>Fecha final estimada: <span>{{ $proyecto->fecha_fin }}</span></label>
                        <form action="{{ url('proyectos/' .$proyecto->id) }}" method="post" id="formEdit">
                            @csrf {{-- token de seguridad para el formulario  --}}
                            {{ method_field('PATCH') }}
                            <input type="text" value="modificacion" name="accion" readonly style="display: none">
                            <label>Costo final: <input type="number" class="editable" name="costo_final" value="{{ $proyecto->costo_final }}"></label>
                            <label>Fecha final: <input type="date" class="editable input2" name="fecha_fin" value="{{ $proyecto->fecha_fin }}"></label>
                        </form>
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
                                    <span class="material-icons add" value="{{ $etapa->id }}">add_circle</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <section class="modal hidden">
                <iframe id="frameModal" src="" frameborder="0" scrolling="no"></iframe>
            </section>
        </div>
    </body>
    </html>
@endsection
