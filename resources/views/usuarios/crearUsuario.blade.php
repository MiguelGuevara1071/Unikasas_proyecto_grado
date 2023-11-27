@extends('layouts.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesRegistrarUsuario.css') }}">
    <title>Registrar usuario</title>
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
        <h1 class="titleModule">Registrar usuario</h1>
        <form class="formulario" action="{{ url('/usuarios') }}" method="POST">
            @csrf {{-- token de seguridad para el formulario  --}}
            <div class="contenedor-campos">
            <div class="campo">
                <label>Primer nombre:</label>
                <input class="input-text" type="text" name="primer_nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$" required>
            </div>
            <div class="campo">
                <label>Segundo nombre:</label>
                <input class="input-text" type="text" name="segundo_nombre" pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$">
            </div>
            <div class="campo">
                <label>Primer apellido:</label>
                <input class="input-text" type="text" name="primer_apellido" pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$" required>
            </div>
            <div class="campo">
                <label>Segundo apellido:</label>
                <input class="input-text" type="text" name="segundo_apellido" pattern="^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$">
            </div>
            <div class="campo">
                <label>Tipo de documento:</label>
                <select name="tipo_documento">
                    <option>Seleccione</option>
                    <option value="CC">Cedula de ciudadanía</option>
                    <option value="CE">Cedula de extranjería</option>
                </select>
            </div>
            <div class="campo">
                <label>Numero de documento:</label>
                <input class="input-text" type="text" name="numero_documento" pattern="^[0-9]{7,12}$" requierd>
            </div>
            <div class="campo">
                <label>Número de teléfono:</label>
                <input class="input-text" type="text" name="telefono_usuario" pattern="[0-9]{10}" required>
            </div>
            <div class="campo">
                <label>Correo electrónico:</label>
                <input class="input-text" type="email" name="email" required>
            </div>
            <div class="campo">
                <label>Roles:</label>
                <select name="rol_id">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
                    @endforeach
                </select>
            </div>
            <div class="campo">
                <label>Estado:</label>
                <select name="estado_usuario">
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>
            </div>
            </div>
            <div class="confirmar">
                <input type="submit" class="button-dos" value="CONFIRMAR">
                <a href="{{ url('usuarios') }}" class="button-uno">CANCELAR</a>
            </div>
        </form>
    </main>
    @endsection
</body>
