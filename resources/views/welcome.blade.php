@extends('layouts.headerHome')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home/inicio.css') }}">
    <title>Unikasas!</title>
</head>
<body>
    @section('content')
    <main class="workspace">
        <form class="filter" action="{{ url('/') }}" method="GET">
            @csrf
            Ordenar por: <select name="filter" id="filter">
                <option value="habitaciones_mayor">Cantidad de habitaciones (Mayor a menor)</option>
                <option value="habitaciones_menor">Cantidad de habitaciones (Menor a mayor)</option>
                <option value="tamaño_mayor">Tamaño de la casa (Mayor a menor)</option>
                <option value="tamaño_menor">Tamaño de la casa (Menor a mayor)</option>
            </select>
            <button>Buscar</button>
            <a href="{{ url('/') }}">Reset</a>
        </form>
        <section class="container">
            @foreach($products as $product)
            <div class="producto">
                <img src="{{ asset('storage/'.$product->image) }}" alt="">
                <h2>{{ $product->nombre_producto }}</h2>
                <div class="data">
                    <p><b>Habitaciones:</b> {{ $product->habitaciones_producto }} habitaciones</p>
                    <p><b>Tamaño:</b> {{ $product->tamaño_producto }}m²</p>
                </div>
                <a href="{{ url('producto/' .$product->id) }}">Ver más imagenes</a>
            </div>
            @endforeach
        </section>
    </main>
    @endsection
</body>
</html>
