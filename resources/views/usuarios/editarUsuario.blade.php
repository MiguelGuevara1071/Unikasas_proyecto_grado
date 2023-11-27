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
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesVerUsuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesRegistrarUsuario.css') }}">
    <title>Usuarios Unikasas</title>
</head>

<body>
    @section('content')
    <main class="workspace">
        <a onclick="history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
        <h1 class="titleModule">Modificar perfil</h1>
        <form class="formulario" action="{{ url('/usuarios/' .$usuario->id) }}" method="POST" id="editForm">
            @csrf {{-- token de seguridad para el formulario  --}}
            {{ method_field('PATCH') }}
            <fieldset>
                <div class="contenedor-campos">
                @if($isMe)
                <div class="campo">
                    <label>Primer nombre</label>
                    <input class="input-text" type="text"  name="primer_nombre" value="{{ $usuario->primer_nombre }}" pattern="[A-Za-z]+" placeholder="Ingrese el primer nombre" required>
                </div>
                <div class="campo">
                    <label>Segundo nombre</label>
                    <input class="input-text" type="text" name="segundo_nombre" value="{{ $usuario->segundo_nombre }}" pattern="[A-Za-z]+" placeholder="Ingrese el primer nombre (Opcional)">
                </div>
                <div class="campo">
                    <label>Primer apellido</label>
                    <input class="input-text" type="text" name="primer_apellido" value="{{ $usuario->primer_apellido }}" pattern="[A-Za-z]+" required placeholder="Ingrese el primer nombre">
                </div>
                <div class="campo">
                    <label>Segundo apellido</label>
                    <input class="input-text" type="text" name="segundo_apellido" value="{{ $usuario->segundo_apellido }}" pattern="[A-Za-z]+" placeholder="Ingrese el primer nombre (Opcional)">
                </div>
                <div class="campo">
                    <label>Tipo de documento</label>
                    <select name="tipo_documento">
                        <option value="{{ $usuario->tipo_documento }}">{{ $usuario->tipo_documento }}</option>
                        <option value="CC">Cedula de ciudadanía</option>
                        <option value="CE">Cedula de extranjería</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Numero de documento</label>
                    <input class="input-text" type="text" name="numero_documento" value="{{ $usuario->numero_documento }}" pattern="[0-9]{7,12}" placeholder="Ej: 1004512201" required>
                </div>
                <div class="campo">
                    <label>Correo electrónico</label>
                    <input class="input-text" type="text" name="email" value="{{ $usuario->email }}" placeholder="Ej: myemail@gmail.com" required>
                </div>
                <div class="campo">
                    <label>Número de teléfono</label>
                    <input class="input-text" type="text" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}" pattern="[0-9]{10}" placeholder="Ej: 3215235872" required>
                </div>
                @endif
                @if($isUserAdmin)
                <div class="campo">
                    <label>Roles</label>
                    <select name="rol_id">
                        @foreach ($rol as $myrol)
                            <option value="{{ $myrol->id }}">{{ $myrol->nombre_rol }}</option>
                        @endforeach
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="campo">
                    <label>Estado</label>
                    <select name="estado_usuario">
                        <option value="{{ $usuario->estado_usuario }}">{{ $usuario->estado_usuario }}</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                @endif
            </fieldset>
        </form>
        <div class="confirmar">
            @if($isMe)
                <a href="#" class="btn" id="button" style="width: 200px;">Modificar contraseña</a>
            @endif
            <button type="submit" form="editForm" class="button-dos">Guardar</button>
            <a onclick="history.back()" class="button-uno">Cancelar</a>
        </div>
    </main>

    <section class="modal hidden">
        <div class="modal-content">
            <!-- Cambiar contraseña -->
            <div class="modal-header">
                <h2>Cambiar contraseña</h2>
                <div class="form">
                    <form action="{{ url('/usuarios/' .$usuario->id) }}" method="POST" id="changePasswordForm">
                        @csrf {{-- token de seguridad para el formulario  --}}
                        {{ method_field('PATCH') }}
                        <div class="campo">
                            <label>Contraseña nueva</label>
                            <input class="input-text" type="password" value="" id="password-one" minlength="8"  maxlength="30" placeholder="Minimo 8 Caracteres. Al menos una letra y un numero" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$" onkeyup="validatePassword()">
                        </div>
                        <div class="campo">
                            <label>Confirme contraseña</label>
                            <input class="input-text" type="password" name="password" value="" id="password-two" onkeyup="validatePassword()" placeholder="Minimo 8 Caracteres. Al menos una letra y un numero" minlength="8" maxlength="30" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$">
                        </div>
                        <button type="submit" form="changePasswordForm" class="btn close" style="display: none;">Cambiar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/usuarios/password.js') }}"></script>
    @endsection
</body>
</html>
