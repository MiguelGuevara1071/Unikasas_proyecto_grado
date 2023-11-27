@extends('layouts.layout')

@section('content')
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="icon" href="data:image/png;base64,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">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
      <link rel="stylesheet" href="{{ asset('css/Cotizaciones/cotizaciones.css')}}">
      <title>Visualizar Cotización</title>
  </head>
  <body>
    <div class="global">
    <a class="btn btn-" onclick="history.back()" role="button" style="margin-left: 4%;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-arrow-left icono" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
    </svg></a>
    <br>
      <h1 style="text-align: center; margin-bottom: 1%"><strong>Visualizar cotización</strong></h1>
      <br>

      <center><div class="card" style="width: 60%; z-index:1">
          @if(isset($producto->image))
            <img src="{{ asset('storage/' .$producto->image) }}" class="card-img-top" style="max-width: 400px; max-height:300px; margin: 20px auto;" class="img-thumbnail img-fluid">
          @endif
          <div class="card-body">
            <h5 class="card-title"><b>Producto: </b>{{ $producto->nombre_producto }}</h5>
            <p class="card-text"><b>Descripción: </b>{{ $producto->descripcion_producto }}</p>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item"> <h5>Valor</h5>$ {{ $producto->precio_producto }}  <p class="card-text"></p></li>
            <li class="list-group-item"><h5>Cotizante</h5>{{ $cotizacion->nombres_cotizante }} {{ $cotizacion->apellidos_cotizante }}<p class="card-text"></p></li>
            <li class="list-group-item"><h5>Datos</h5><strong>Email: </strong> {{ $cotizacion->email_cotizante }} &nbsp;<strong> Telefono: </strong>{{ $cotizacion->telefono_cotizante }} &nbsp;<strong> Ciudad: </strong> {{ $cotizacion->ciudad_cotizante}} <br> <strong>Fecha: </strong> {{ $cotizacion->fecha_cotizacion}} &nbsp;<strong>Estado: </strong> {{ $cotizacion->estado_cotizacion}} &nbsp;<strong> Ubicacion: </strong>{{ $cotizacion->ubicacion_cotizante}} <p class="card-text"></p></li><br>
            <li class="list-group-item"><h5>Comentarios</h5> {{ $cotizacion->comentarios_cotizacion }}<p class="card-text"></p></li>
          </ul>
          <div class="card-body">
            <a href="{{ url('cotizaciones') }}"><button type="button" class="btn btn-lg btn-warning buttonRegresar" data-bs-toggle="popover" title="Click para regresar" data-bs-content="And here's some amazing content. It's very engaging.Right?">Regresar</button></a>
          </div>
        </div>
      </div>
  </body>
  </html>
@endsection
