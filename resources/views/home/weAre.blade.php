@extends('layouts.headerHome')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home/weAre.css') }}">
    <title>Nosotros</title>
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
        <section>
            <h2>Nosotros</h2>
            <p>
                Somos una empresa que se dedica a la venta de productos de construcción.
                Nuestros productos son de calidad y son fabricados por nuestros propios
                especialistas en la construcción.
            </p>
        </section>

        <section>
            <h2>Misión</h2>
            <p>
                Ofrecer a nuestros clientes productos de calidad y de alta tecnología.
            </p>
        </section>

        <section>
            <h2>Visión</h2>
            <p>
                Ser la empresa líder en la venta de productos de construcción.
            </p>
        </section>
    </main>
    @endsection
</body>
</html>
