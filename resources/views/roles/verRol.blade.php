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
    <link rel="stylesheet" href="{{ asset('css/roles/stylesVerRol.css') }}">
    <title>Usuarios Unikasas</title>
</head>

<body>
    @section('content')
    <main class="workspace">
        <a href="{{ url('roles') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
    <h1 class="titleModule">Información del rol</h1>
    <div class="uno">
        <div class="info-usuario info-rol">
            <svg xmlns="http://www.w3.org/2000/svg" class="foto-usuario foto-rol" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="18" r="2" />
                <circle cx="7" cy="6" r="2" />
                <circle cx="17" cy="6" r="2" />
                <path d="M7 8v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2" />
                <line x1="12" y1="12" x2="12" y2="16" />
              </svg>
        <div class= "info-texto">
            <h2>{{ $rol->nombre_rol }}</h2>
            <h3>Privilegios:</h3>
            <ul>
                @foreach($privilegios as $privilegio)
                <li style="font-weight: bold; color: black;">{{ $privilegio->nombre_privilegio }}</li>
                @endforeach
            </ul>

        </div>
            @if($isAdmin)
            <div class="botones modificar">
            <a href="{{ url('roles/' .$rol->id. '/edit') }}" class="button-uno">Modificar rol</a>
            </div>
            @endif
        </div>
</a>
    </div>
</main>
@endsection
</body>
