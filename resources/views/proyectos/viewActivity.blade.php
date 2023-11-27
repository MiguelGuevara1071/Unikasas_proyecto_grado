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
    <title>Proyecto</title>
</head>
<body>
    <section class="modal" style="display: grid;">
        <div class="modal__content modalActivity">
            <div class="iconClose">
                <a onclick="history.back()"><span class="material-icons closeIcon">highlight_off</span></a>
            </div>
            <div class="modal__content--contenedor">
                <h2>{{ $actividad->nombre_actividad }}</h2>
                <div class="infoActividad">
                    <div class="data1">
                        <b>Encargado:</b>
                        <b>{{ $actividad->encargado_actividad }}</b>
                        <b>Objetivo:</b>
                        <b>{{ $actividad->objetivo_actividad }}</b>
                        <b>Fecha inicio:</b>
                        <b>{{ $actividad->fecha_inicio }}</b>
                        <b>Fecha fin:</b>
                        <b>{{ $actividad->fecha_fin }}</b>
                        <b>Observaciones:</b>
                        <b>{{ $actividad->observaciones_actividad }}</b>
                        <b>Estado:</b>
                        <b>{{ $actividad->estado_actividad }}</b>
                    </div>
                </div>
                @if($actividad->estado_actividad == "ejecucion")
                    <div class="botones">
                        <button class="finish" type="button">Completar actividad</button>
                        <a href="{{ url('actividades/'. $actividad->id. '/edit') }}"><span class="material-icons edit">edit</span></a>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <!-- modales -->
    <section class="modal hidden" style="background: #000;">
        <div class="modal__content modalActivity" style="height: 250px;">
            <div class="iconClose">
                <span class="material-icons closeIcon" onclick="history.back()">highlight_off</span>
            </div>
            <div class="modal__content--contenedor">
                <form action="{{ url('actividades/' .$actividad->id) }}" method="post">
                    @csrf {{-- token de seguridad para el formulario  --}}
                    {{ method_field('PATCH') }}
                    <h2>¿Desea dar por finalizada la actividad?</h2>
                    <input type="text" name="nombre_actividad" value="{{ $actividad->nombre_actividad }}" readonly style="display: none;">
                    <input type="text" name="estado_actividad" value="finalizada" readonly style="display: none;">
                    <div class="botones">
                        <button type="submit">CONFIRMAR</button>
                        <button type="button" class="cancel">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/proyectos/viewActivity.js') }}"></script>
</body>
</html>
