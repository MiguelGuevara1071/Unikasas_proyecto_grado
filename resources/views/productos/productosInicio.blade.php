@extends('layouts.layout')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edggit checkout git 6c8364aa7e6dd2b174cae3c3162500a69c6a4280e">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIKASAS</title>

   <!-- <link rel="stylesheet" href="{{asset('css/productosCss/modalP.css')}}">
    <link rel="stylesheet" href="{{asset('css/productoCss/publicar.css')}}">
    <link rel="stylesheet" href="{{asset('css/productosCss/mPublicarProducto.css')}}">-->
    <link rel="stylesheet" href="{{ asset('css/productosCss/productosInicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productosCss/modales.css') }}">
</head>
<body>
    @section('content')
    <main>
        <!--modal publicar-->
        <section class="modal hidden">
            <div class="modal__content">
                <h2>¿Desea publicar el producto?</h2>
                <form method="post" id="publicarForm">
                    @csrf {{-- token de seguridad para el formulario  --}}
                    {{ method_field('PATCH') }}
                    <input type="text" value="Publicado" name="estado_Producto" readonly style="display: none;">
                    <input type="text" value="publicación" name="accion" readonly style="display: none;">
                    <div class="modal__content__buttons">
                        <button class="modal__content__buttons__button confirmar close" type="submit">Publicar</button>
                        <a href="#" class="modal__content__buttons__button cancelar close">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>

        <!--modal despublicar-->
        <section class="modal hidden">
            <div class="modal__content publicar">
                <h2>¿Desea despublicar el producto?</h2>
                <form method="post" id="despublicarForm">
                    @csrf {{-- token de seguridad para el formulario  --}}
                    {{ method_field('PATCH') }}
                    <input type="text" value="Activo" name="estado_Producto" readonly style="display: none;">
                    <input type="text" value="despublicación" name="accion" readonly style="display: none;">
                    <div class="modal__content__buttons">
                        <button class="modal__content__buttons__button confirmar close" type="submit">Despublicar</button>
                        <a href="#" class="modal__content__buttons__button cancelar close">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>


        <h1>PRODUCTOS</h1>
        <div class="label">
            <form class="searchForm" action="{{ url('productos') }}">
                <label>Buscar Producto:</label>
                <input type="text" name="search" class="searchBar">
                <input type="submit" value="Buscar" class="send">
            </form>
        </div>
<!--Fin modal producto-->
        <div class="prueba">
            @if($isProductoAdmin)
            <div class="Botones">
                <div class="botonP">
                <a class="bot" id=""href="{{url('/productos/create')}}">Registrar Producto</a>
                </div>
                <div class="botonP">
                <a class="bot"href="{{url('/reporteProductos')}}">CREAR REPORTE</a>
                </div>
            </div>
            @endif
        <div class="maincenter">


            <div class="MatrizProductos main">
                @foreach($productos as $producto)
                <div class="caja">
                    <h2>{{$producto->nombre_producto}}</h2> <!--Casa 1-->
                    <img src="{{ asset('storage/'. $producto->imagen) }}" alt="" />
                    <div class="iconos">
                        <a href="{{url('productos/'.$producto->id)}}"><svg  class="eye" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="2" />
                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                        </svg></a>

                        @if($producto->estado_Producto == 'Publicado')
                        <span id="despublicar-button" value="{{ $producto->id }}">
                        <svg class="bot1 x"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg></span>
                        @else

                        <span id="publicar-button" value="{{ $producto->id }}">
                        <svg  id="carrito" class="mCarOne carShop"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="6" cy="19" r="2" />
                            <circle cx="17" cy="19" r="2" />
                            <path d="M17 17h-11v-14h-2" />
                            <path d="M6 5l14 1l-1 7h-13" />
                        </svg></span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="contenedorpaginacion">
                <p class="parrafoPaginacion">{{ $productos->links() }}</p>
            </div>
        </div>
        </div>
    </main>
    <script src="{{ asset('js/productos/modales.js') }}"></script>
    @endsection
</body>
</html>
