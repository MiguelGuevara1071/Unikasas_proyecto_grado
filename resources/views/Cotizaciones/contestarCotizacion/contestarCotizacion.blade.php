@extends('layouts.layout')

@section('content')
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="icon" href="data:image/png;base64,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">
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
      <link rel="stylesheet" href="{{ asset('css/Cotizaciones/cotizaciones.css')}}">
      <title>Responder cotización</title>
  </head>
  <body>
    <div class="global">
    <a class="btn btn-" onclick="history.back()" role="button" style="margin-left: 4%;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-arrow-left icono" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
    </svg></a>
      <h1 style="text-align: center; margin-bottom: 2%"><strong>Responder cotización</strong></h1>
      <div class="container">
      <form class="row g-4" action="{{ url('cotizaciones/'.$cotizacion->id) }}" method="post">
          @csrf {{-- token de seguridad para el formulario  --}}

            {{ method_field('PATCH') }}

          <div class="col-md-4">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control formborder" placeholder="Nombre" name="nombres_cotizante"
            value="{{ isset($cotizacion->nombres_cotizante)?$cotizacion->nombres_cotizante:old('nombre_cotizante') }}" readonly>
          </div>

          <div class="col-md-4">
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control formborder" placeholder="Apellido" name="apellidos_cotizante"
            value="{{ isset($cotizacion->apellidos_cotizante)?$cotizacion->apellidos_cotizante:old('nombre_cotizante') }}" readonly>
          </div>

          <div class="col-md-4">
            <label class="form-label">Correo electronico</label>
            <div class="input-group has-validation">
              <span class="input-group-text formborderDos" id="inputGroupPrepend3" value="Email">@</span>
              <input type="email" class="form-control formborder" placeholder="Email" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required name="email_cotizante"
              value="{{ isset($cotizacion->email_cotizante)?$cotizacion->email_cotizante:old('email_cotizante') }}" readonly>
            </div>
          </div>

          <div class="col-md-4">
            <label class="form-label">Telefono</label>
            <input type="text" class="form-control formborder" placeholder="Telefono" aria-describedby="validationServer03Feedback" required name="telefono_cotizante"
              value="{{ isset($cotizacion->telefono_cotizante)?$cotizacion->telefono_cotizante:old('telefono_cotizante') }}" readonly>
          </div>

          <div class="col-md-4">
              <label class="form-label">Ciudad</label>
              <input type="text" class="form-control formborder" placeholder="Telefono" aria-describedby="validationServer03Feedback" required name="ciudad_cotizante"
                value="{{ isset($cotizacion->ciudad_cotizante)?$cotizacion->ciudad_cotizante:old('ciudad_cotizante') }}" readonly>
            </div>

            <div class="col-md-4">
              <label class="form-label">Producto</label>
              <select class="form-select" placeholder="Producto" aria-describedby="validationServer04Feedback" required name="producto_id" readonly hidden>
                <input type="text" class="form-control formborder" value="{{ $producto->id }} - {{ $producto->nombre_producto }}" readonly>
                  <option readonly hidden value="{{ $producto->id }}">{{ $producto->id }} - {{ $producto->nombre_producto }}</option>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label">Ubicacion</label>
              <input type="text" class="form-control formborder" placeholder="Ubicacion" aria-describedby="validationServer05Feedback" required name="ubicacion_cotizante"
                  value="{{ isset($cotizacion->ubicacion_cotizante)?$cotizacion->ubicacion_cotizante:old('ubicacion_cotizante') }}" readonly>
            </div>

            <div class="col-md-4">
              <label class="form-label">Fecha</label>
              <input type="date" class="form-control formborder" placeholder="Fecha" aria-describedby="validationServer05Feedback" required name="fecha_cotizacion"
                  value="{{ isset($cotizacion->fecha_cotizacion)?$cotizacion->fecha_cotizacion:old('fecha_cotizacion') }}" readonly>
            </div>

            <div class="col-md-4 inputValidate">
              <label for="estadoCotizacion" class="form-label">Estado</label>
              <select class="form-select formborder" id="estadoCotizacion" placeholder="Ciudad" aria-describedby="validationServer04Feedback" required name="estado_cotizacion">
                <option value="{{ isset($cotizacion->estado_cotizacion)?$cotizacion->estado_cotizacion:old('estado_cotizacion') }}">{{ isset($cotizacion->estado_cotizacion)?$cotizacion->estado_cotizacion:old('estado_cotizacion') }}</option>
                <option value="Respondida">Respondida</option>
                <option value="Cancelada">Cancelada</option>
                <option value="Por respondrer">Por respondrer</option>
              </select>
              <span id="estadoCotizacion_error_message" class="error_form"></span>
            </div>

            <div class="row g-1" style="margin-left: 1%"><br>
              <label for="comentarios" class="form-label">Comentarios</label>
              <textarea id="comentarios" class="formborder" rows="4" name="comentarios_cotizacion" style="width: 98%; background-color: #e9ecef; opacity: 1; border-radius: 0.25rem" readonly>  {{ isset($cotizacion->comentarios_cotizacion)?$cotizacion->comentarios_cotizacion:old('comentarios_cotizacion') }}
              </textarea>
          </div>

            <div class="row g-1 inputValidate" style="margin-left: 1%"><br>
              <label for="respuestaCotizacion" class="form-label">Respuesta de la cotización</label>
              <textarea id="respuestaCotizacion" class="formborder" rows="4" name="respuesta_cotizacion" placeholder="Ingrese la respuesta de la cotización..." value="Ingrese la respuesta de la cotización..." style="width: 98%; border-radius: 0.25rem"></textarea>
              <span id="respuestaCotizacion_error_message" class="error_form"></span>
            </div>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 28vh">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="D" id="exampleModalLabel"> Enviar respuesta de cotización</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ¿Esta seguro de que desea enviar la respuesta de la cotización?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-primary">Si</button>
                </div>
              </div>
            </div>
          </div>
          {{-- <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">

          </button> --}}

          <div class="container row g-2" style="margin-bottom: 1.5%; margin-top: 1.5%">
            <div class="row gap-10" style="margin: 0 auto;">
              <div class="col-3"></div>
              <div class="col-3">
                <button class="btn btn-warning buttonUno" id="submit" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" disabled>Responder</button>
              </div>
              <div class="col-3">
                <a href="{{ url('cotizaciones')}}"><button class="btn btn-danger buttonDos" type="button">Cancelar</button></a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
      <script src="{{ asset('js/Cotizaciones/validateResponderCotizacion.js') }}"></script>
  </body>
  </html>
@endsection
