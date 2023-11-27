@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/productosCss/visualizarProducto.css')}}">
    <title>UNIKASAS</title>
</head>
<body>
@section('content')
    <section class="main">
        <h1>{{ $producto->nombre_producto }}</h1>

        <div class="division">
                <!-- Slideshow container -->
                <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                @foreach($images as $image)
                    <div class="mySlides fade">
                        <img src="{{ asset('storage/'. $image->path) }}" class="image">
                    </div>
                @endforeach

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>

                    <!-- The dots/circles -->
                <div style="text-align:center">
                    <?php $count = 1; ?>
                    @foreach($images as $image)
                    <span class="dot" onclick="currentSlide({{ $count++ }})"></span>
                    @endforeach
                </div>

                <table class="dataProduct">
                    <thead>
                        <caption>INFORMACIÓN DEL PRODUCTO</caption>
                    </thead>
                    <tbody>
                        <!-- Assigning width of first
                            column of each row as 40% -->
                        <col style="width: 40%;" />

                        <!-- Assigning width of second
                            column of each row as 60% -->
                        <col style="width: 60%;" />
                        <tr>
                            <td><b>ID:</b> {{ $producto->id }}</td>
                            <td><b>Nombre:</b> {{ $producto->nombre_producto }}</td>
                        </tr>
                        <tr>
                            <td><b>Descripción:</b> {{ $producto->descripcion_producto }}</td>
                            <td><b>Precio:</b> {{ $producto->precio_producto }}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo:</b> {{ $producto->tipo_producto }}</td>
                            <td><b>Material:</b> {{ $producto->material_producto }}</td>
                        </tr>
                        <tr>
                            <td><b>Tamaño:</b> {{ $producto->tamaño_producto }}m²</td>
                            <td><b>Habitaciones:</b> {{ $producto->habitaciones_producto }} habitaciones</td>
                        </tr>
                        <tr>
                            <td><b>Pisos:</b> {{ $producto->pisos_producto }}</td>
                            <td><b>Estado:</b> {{ $producto->estado_Producto }}</td>
                        </tr>
                    </tbody>
                </table>
                <!--<div class="botones">-->
                    <div class="botones">
                        @if($isProductoAdmin)
                        <div class="Modificar">
                            <a href="{{url('productos/'.$producto->id.'/edit')}}">MODIFICAR</a>
                        </div>
                        @endif
                        <div class="Eliminar">
                            <a href="{{url('productos')}}">REGRESAR</a>
                        </div>
                    </div>
                <!--</div>-->


        </div>
    </section>
    <script src="{{ asset('js/productos/showImage.js') }}"></script>
@endsection

</body>
</html>
