@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="moduloInicioProyecto.css">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesVerUsuario.css') }}">
    <title>Usuarios Unikasas</title>
</head>

<body>
    @section('content')
    <main class="workspace">
        <a href="{{ url('usuarios') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
    <h1 class="titleModule">Perfil</h1>
    <div class="uno">
        <div class="info-usuario">
        <svg xmlns="http://www.w3.org/2000/svg" class="foto-usuario" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <circle cx="12" cy="10" r="3" />
            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
          </svg>
        <div class= "info-texto">
            <h2>{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }} {{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</h2>
            <h3>Tipo de documento: {{ $usuario->tipo_documento }}</h3>
            <h3>Numero de documento: {{ $usuario->numero_documento }}</h3>
            <h3>Correo electrónico: {{ $usuario->email }}</h3>
            <h3>Teléfono: {{ $usuario->telefono_usuario }}</h3>
            @foreach($rol as $rol)
                <h3>Rol de usuario: {{ $rol->nombre_rol }}</h3>
            @endforeach
            <h3>Estado: {{ $usuario->estado_usuario }}</h3>
        </div>
        <div>

        </div>
        <div class="botones">
            @if($isUserAdmin || $isMe)
            <a href="{{ url('usuarios/' .$usuario->id. '/edit') }}" class="button-uno">Modificar información</a>
            @endif
        </div>
        </div>
    </div>
    </main>
@endsection
</body>
