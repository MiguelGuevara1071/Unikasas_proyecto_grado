@extends('layouts.headerHome')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home/product.css') }}">
    <title>Unikasas!</title>
</head>
<body>
    @section('content')
    <main class="workspace">
        <a href="{{ url('/') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
        <section class="container">
            <!-- Slideshow container -->
            <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
                @foreach($images as $image)
                <div class="mySlides fade">
                    <img src="{{ asset('storage/' .$image->path) }}" class="image">
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
        </section>
        <aside class="info">
            <h2>{{ $product->nombre_producto }}</h2>
            <div class="data">
                <p><b>Material:</b> {{ $product->material_producto }}</p>
                <p><b>Pisos:</b> {{ $product->pisos_producto }}</p>
            </div>
            <a class="cotizar" href="{{ url('producto/' .$product->id. '/cotizar') }}">Cotizar</a>
        </aside>
    </main>
    <script src="{{ asset('js/productos/showImage.js') }}"></script>
    @endsection
</body>
</html>
