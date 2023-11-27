<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/proyectos/viewProyecto.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/proyectos/viewActividad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/proyectos/editActividad.css') }}">
    <title>Proyecto</title>
</head>
<body>
    <section class="modal">
        <div class="modal__content modalActivity">
            <div class="iconClose">
                <span class="material-icons closeIcon" onclick="history.back()">highlight_off</span>
            </div>
            <div class="modal__content--contenedor">

                <h2>{{ $actividad->nombre_actividad }}</h2>
                <div class="infoActividad">
                    <form action="{{ url('/actividades/'. $actividad->id) }}" method="POST">
                        @csrf {{-- token de seguridad para el formulario  --}}
                        {{ method_field('PATCH') }}
                        <input type="text" value="{{ $actividad->nombre_actividad }}" name="nombre_actividad" style="display: none">
                        <div class="infoActividad">
                            <div class="campo">
                                <label>Encargado:</label>
                                <input type="text" name="encargado_actividad" value="{{ $actividad->encargado_actividad }}" readonly>
                            </div>
                            <div class="campo">
                                <label>Objetivo:</label>
                                <textarea name="objetivo_actividad" id="" cols="40" rows="3" maxlength="100" readonly>{{ $actividad->objetivo_actividad }}</textarea>
                            </div>
                            <div class="campo">
                                <label>Fecha inicio:</label>
                                <input type="date" name="fecha_inicio" readonly value="{{ $actividad->fecha_inicio }}">
                            </div>
                            <div class="campo">
                                <label>Fecha fin:</label>
                                <input type="date" name="fecha_fin" readonly value="{{ $actividad->fecha_fin }}">
                            </div>
                            <div class="campo">
                                <label>Observaciones:</label>
                                <textarea name="observaciones_actividad" id="" cols="40" rows="4">{{ $actividad->observaciones_actividad }}</textarea>
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input type="text" name="estado_actividad" value="{{ $actividad->estado_actividad }}" readonly>
                            </div>
                            <div class="botones">
                                <input class="save" type="submit" value="Guardar cambios" id="save"></input>
                                <button class="save" type="button" onclick="history.back()">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/proyectos/viewActivity.js') }}"></script>
</body>
</html>
