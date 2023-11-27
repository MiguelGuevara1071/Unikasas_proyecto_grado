@extends('layouts.layout')
@section('content')
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
        <link rel="stylesheet" href="{{ asset('css/usuarios/stylesInicioUsuarios.css') }}"">
        <title>Usuarios Unikasas</title>
    </head>

        <main class="workspace">
            <h1 class="titleModule">Roles</h1>
            <form class="searchForm" action="{{ url('roles') }}">
                <label>Buscar rol:</label>
                <input type="text" name="search" id="searchBar" pattern="^[A-Za-z]+$">
                <input type="submit" value="Buscar">
            </form>
            <div class= "lista-usuarios">
            <h3>Todos los roles</h3>
            </div>
            <div class= "uno">
            <div class="container">
                <aside>
                    @if($isAdmin)
                    <div class="button">
                        <a class="buttonCreateProject" href="{{ url('roles/create') }}">Crear rol</a>
                    </div>
                    @endif
                </aside>
                <div class="usuarios">
                    @foreach ($roles as $rol)
                    <section>
                        <div class="contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-git-fork" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="18" r="2" />
                                <circle cx="7" cy="6" r="2" />
                                <circle cx="17" cy="6" r="2" />
                                <path d="M7 8v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2" />
                                <line x1="12" y1="12" x2="12" y2="16" />
                            </svg>
                            <div class="nombre-usuario">
                                <h2 class="info">{{ $rol->nombre_rol }}</h2>
                            </div>
                            <a href="{{ url('roles/' .$rol->id) }}" class="visualizar">Ver información</a>
                        </div>
                    </section>
                    @endforeach
                    <div class="contenedorpaginacion">
                        <p class="parrafoPaginacion">{{ $roles->links() }}</p>
                    </div>
                </div>
                <a href="{{ url('usuarios') }}">
                <aside class="roles flex alinear-derecha">
                    <div class="roles-icono">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icono" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="12" r="9" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                        </svg>
                    </div>
                    <h3 class="rol">Usuarios</h3>
                </aside>
            </a>
            </div>
            </div>
        </main>
    </body>
    </html>
@endsection
