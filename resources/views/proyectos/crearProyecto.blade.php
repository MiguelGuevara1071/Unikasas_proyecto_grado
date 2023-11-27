@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CrearProyecto</title>
        <link rel="stylesheet" href="{{ asset('css/proyectos/crearProyecto.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="main">
            <h1 class="titleModule">Crear proyecto</h1>
            <div class="formulario">
                <form action="{{ url('/proyectos') }}" method="POST" id="myForm">
                    @csrf {{-- token de seguridad para el formulario  --}}
                    <div class="contenedor-campos">
                        <h2><strong>Información general del proyecto</strong></h2>
                        <div class="campo">
                            <label>Nombre del proyecto:</label>
                            <div class="inputValidate">
                                <input type="text" placeholder="Nombre del proyecto..." name="nombre_proyecto" id="projectName">
                                <span id="projectName_error_message" class="error_form"></span>
                            </div>
                        </div>
                        <div class="campo">
                            <label>Encargado del proyecto:</label>
                            <div class="inputValidate">
                                <select class="campomedio bigField" name="encargado_id" id="projectDirector">
                                    <option value="null" selected disabled hidden>Selecciona un encargado para el proyecto</option>
                                    @foreach($encargados as $encargado)
                                    <option value="{{ $encargado->id }}">{{ $encargado->primer_nombre }} {{ $encargado->segundo_nombre }} {{ $encargado->primer_apellido }} {{ $encargado->segundo_apellido }}</option>
                                    @endforeach
                                </select>
                                <span id="projectDirector_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <div class="campo">
                            <label>Costo estimado:</label>
                            <div class="inputValidate">
                                <input type="number" class="campomedio" name="costo_estimado" id="projectCost">
                                <span id="projectCost_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <div class="campo campoDoble">
                                <label>Ciudad:</label>
                                <div class="inputValidate">
                                    <input type="text" class="city" name="ciudad_proyecto" id="projectCity">
                                    <span id="projectCity_error_message" class="error_form"></span>
                                </div>

                                <label class="ciudad">Dirección:</label>
                                <div class="inputValidate">
                                    <input type="text" class="address" name="direccion_proyecto" id="projectAddress">
                                    <span id="projectAddress_error_message" class="error_form"></span>
                                </div>

                        </div>

                        <div class="campo campoDoble">
                            <label>Fecha inicio del proyecto: </label>
                            <div class="inputValidate">
                                <input type="date" class="date" name="fecha_inicio" id="startDate">
                                <span class="projectDate_error_message" class="error_form"></span>
                            </div>

                            <label>Fecha fin del proyecto: </label>
                            <div class="inputValidate">
                                <input type="date" class="date" name="fecha_fin" id="finalDate">
                                <span class="projectDate_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <h2><strong>Información del producto</strong></h2>

                        <div class="campo">
                            <label>Producto:</label>
                            <div class="inputValidate">
                                <select type="number" class="product" list="producto" name="producto_id" id="projectProduct">
                                    <option value="null" selected disabled hidden>Selecciona el producto del proyecto...</option>
                                    @foreach($productos as $producto)
                                    <option class="idProduct" value="{{ $producto->id }}">{{ $producto->nombre_producto }}</option>
                                    @endforeach
                                </select>
                                <span id="projectProduct_error_message" class="error_form"></span>
                            </div>


                        </div>

                        <h2><strong>Información del cliente</strong></h2>

                        <div class="campo">
                            <label style="padding-right: 1.5%;">Cliente:</label>
                            <div class="inputValidate">
                                <div class="input">
                                    <input value="" type="text" list="cliente" id="projectClient" name="cliente_id" style="width: 98%;" onchange="imprimirCliente()">
                                    <datalist id="cliente" value="">
                                        @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }} {{ $cliente->primer_nombre }} {{ $cliente->segundo_nombre }} {{ $cliente->primer_apellido }} {{ $cliente->segundo_apellido }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <span id="projectClient_error_message" class="error_form"></span>
                            </div>
                        </div>

                        <div class="campo cliente">
                            <label>Primer nombre cliente:</label>
                            <input type="text" readonly value="" id="primer_nombre">
                            <label>Segundo nombre cliente:</label>
                            <input type="text" readonly value="" id="segundo_nombre">
                        </div>

                        <div class="campo cliente">
                            <label>Primer apellido cliente:</label>
                            <input type="text" readonly value="" id="primer_apellido">
                            <label>Segundo apellido cliente</label>
                            <input type="text" readonly value="" id="segundo_apellido">
                        </div>

                        <div class="botones">
                            <input class="confirm" type="submit" value="CONFIRMAR" id="submit"></input>
                            <a class="cancel" href="{{ url('proyectos/search/activo') }}">CANCELAR</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/proyectos/validate.js') }}"></script>
        <script src="{{ asset('js/proyectos/completarForm.js') }}"></script>

    </body>
    </html>
@endsection
