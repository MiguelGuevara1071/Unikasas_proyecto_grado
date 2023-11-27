<?php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    $nombre_rol = \DB::table('rols')->where('id', $user->rol_id)->get('nombre_rol');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/layout/styles.css') }}">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <title>Proyectos Unikasas</title>
</head>
<body>
    <header class="header">
        <nav class="header__navBar">
            <div class="header__navBar__iconsleft">
                <span class="material-icons md-200" id="userIcon">person</span>
                <h1 class="header__navBar__iconsleft__userName">{{ $user->primer_nombre }} {{ $user->segundo_nombre }} {{ $user->primer_apellido }} {{ $user->segundo_apellido }} ({{ $nombre_rol[0]->nombre_rol }})</h1>
            </div>
            <div class="header__navBar__iconsRight">
                <span class="material-icons md-200 logout">logout</span>
                <span class="material-icons md-200 notifications">notifications</span>
                <span class="material-icons md-200 calendar">calendar_today</span>
                <span class="material-icons md-200 help" >help_outline</span>
            </div>
        </nav>
    </header>
    <div class="divPrueba">
        <div class="navLateral">
            <ul class="navLateral__sidebar">
                <a href="{{ url('cotizaciones') }}"><span class="material-icons md-100 cotizaciones">assignment</span></a>
                <li><a href="#">Cotizaciones</a></li>
                <a href="{{ url('productos') }}"><span class="material-icons md-100 products">shopping_cart</span></a>
                <li><a href="#">Productos</a></li>
                <a href="{{ url('proyectos/search/activo') }}"><span class="material-icons md-100 projects">folder_open</span></a>
                <li><a href="{{ url('proyectos/search/activo') }}">Proyectos</a></li>
                <a href="{{ url('eventos') }}"><span class="material-icons md-100 events">event</span></a>
                <li><a href="#">Eventos</a></li>
                <a href="{{ url('usuarios') }}"><span class="material-icons md-100 users">person</span></a>
                <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
                <a href="{{ url('auditoria') }}"><span class="material-icons md-100 auditoria">verified_user</span></a>
                <li><a href="#">Auditoria</a></li>
            </ul>
        </div>

        <section class="modalLayout hidden">
            <div class="modalLogout">
                <form action="{{ url('logout') }}" method="POST">
                @csrf {{-- token de seguridad para el formulario  --}}
                    <button type="submit">Cerrar sessión</button>
                </form>

            </div>
        </section>
        <section class="modalLayout hidden">
            <div class="modalNotifications">
                @if(isset($notificaciones))
                <ul>
                    @foreach ($notificaciones as $notificacion)
                        <li>Hay {{ $notificacion['cantidad'] }} {{ $notificacion['tipo'] }} pendientes</li>
                    @endforeach
                </ul>
                @else
                    <li>No existen cotizaciones pendientes</li>
                @endif
            </div>
        </section>
        <section class="modalLayout hidden">
            <div class="modalNotifications"> 
                <ul>@if(isset($eventosDelDiaHoy))
                        <?php $cont = 1; ?>
                        @forelse ($eventosDelDiaHoy as $evento)
                            @if($cont == 1)
                                <li>Eventos existentes para el dia de hoy</li>
                                <?php $cont += 1;?>
                            @endif
                            <li><a href="{{ url('eventos/'.$evento->id) }}" class="eventoHoy"><b>Dia: </b>{{ date('d - M', strtotime($evento->fecha_evento)) }} <b>Hora de inicio:</b> {{ date('h:i A', strtotime($evento->hora_inicio)) }} <b> Hora final:</b> {{ date('h:i A', strtotime($evento->hora_fin)) }} </a></li>
                        @empty
                            <li>No tiene eventos agendados para el dia de hoy</li>
                        @endforelse
                    @endif
                </ul>
            </div>
        </section>

        <section class="modalLayout hidden">
            <div class="modalHelp">
                <h2>Instrucciones de uso:</h2>
                <figure>
                    <img src="https://cutt.ly/bIB5a2e" alt="">
                </figure>
            </div>
        </section>
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/layout/app.js') }}"></script>
</html>
