@extends('layouts.layout')

@section('content')
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Registro de cotizaciones</title>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="icon" href="data:image/png;base64,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">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
      <link rel="stylesheet" href="{{ asset('css/Cotizaciones/cotizaciones.css')}}">
    </head>
  <body>
    <div class="global">
    <form action="">
    {{-- <a class="btn btn-" onclick="history.back()" role="button" style="margin-left: 4%;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
      <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
    </svg></a> --}}
    <h1 class="tituloModulo">Cotizaciones</h1>
    <div class="container">
      <div class="row row-cols-5">

      <div class="mb-2 row row row col-2">
        <label for="ciudad" class="col-sm-4 control-label" style="margin-right: 5.5%; margin-top: 3%; font-weight: 600">Codigo:</label>

        <div class="col-sm-7">
                <select class="form-control text-white bg-dark borderBusqueda" class="dropdown" name="codigo" id="codigo">
                  <option value="null" selected disabled hidden>Filtrar</option>
                    @foreach ($cotizaciones as $cotizacion)
                        <option value="{{ $cotizacion->id }}">{{ $cotizacion->id}}</option>
                    @endforeach
                </select>
            </div>
    </div>

      <div class="mb-2 row row row col-3">
        <label for="ciudad" class="col-sm-3 control-label" style="margin-top: 2%; font-weight: 600">Cliente:</label>

        <div class="col-sm-8">
                <select class="form-control text-white bg-dark borderBusqueda" name="cliente" id="cliente">
                  <option value="null" selected disabled hidden>Filtrar</option>
                    @foreach ($cotizaciones as $cotizacion)
                        <option value="{{ $cotizacion->nombres_cotizante }}">{{ $cotizacion->nombres_cotizante}} {{ $cotizacion->apellidos_cotizante}}</option>
                    @endforeach
                </select>
            </div>
    </div>

    <div class="mb-2 row row row col-3">
      <label for="ciudad" class="col-sm-3 control-label" class="dropdown" style="margin-top: 2%; font-weight: 600">Fecha:</label>
      <div class="col-sm-8">
              <input type="date"class="form-control text-white bg-dark borderBusqueda" name="fecha" id="fecha1" style="color-scheme: dark;">
          </div>
  </div>

    <div class="mb-2 row row row col-3">
      <label for="ciudad" class="col-sm-3 control-label" style="margin-top: 2%; font-weight: 600">Estado:</label>

      <div class="col-sm-8">
              <select class="form-control text-white bg-dark borderBusqueda" name="estado" id="estado">
                <option value="null" selected disabled hidden>Filtrar</option>
                <option value="Por responder">Por responder</option>
                <option value="Respondida">Respondida</option>
                <option value="Cancelada">Cancelada</option>
              </select>
          </div>
  </div>
        <input type="submit" class="btn btn-warning buscar" value="Buscar">
      </div>
      </div>
    </div>
    <br>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>

    <div class="grid">
      <div>
    <aside class="botones">
        @if($isAdmin)
      <div>
        <a href="{{ url('/cotizaciones/create') }}"><button style="justify-content: center; width: 165px; padding: 1.5%; margin-bottom: 2vh"  type="button" class="btn btn-lg button" data-bs-toggle="popover" title="Click para ver el reporte en formato pdf o excel" data-bs-content="And here's some amazing content. It's very engaging.Right?" style="font-size: 1.20rem; font-weight: 500">CREAR NUEVA</button></a>
      </div>
      <div style="margin-top: 3%">
        <a href="{{ url('/exportPdfCotizaciones') }}"><button style="justify-content: center; width: 165px; padding: 1.5%" type="button" class="btn btn-lg button" data-bs-toggle="popover" title="Click para ver el reporte en formato pdf o excel" data-bs-content="And here's some amazing content. It's very engaging.Right?" style="font-size: 1.20rem; font-weight: 500">REPORTE PDF</button></a>
      <div>
          @endif
    </aside>
  </div>

      <div class="container" id="tabla" style="display: inline;">
          <div class="row row-cols-5">
            <div class="col- border border-dark color"><b>Codigo</b></div>
            <div class="col- border border-dark color" style="text-align: center"><b>Cliente</b></div>
            <div class="col- border border-dark color" style="text-align: center"><b>Fecha</b></div>
            <div class="col- border border-dark color" style="text-align: center"><b>Estado</b></div>
            <div class="col- border border-dark color" style="text-align: center"><b>Opciones</b>

          </form>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                </div>
              </div>
            </div></div>

            <!-- Tabla con datos de las cotizaciones -->
            @foreach ($cotizaciones as $cotizacion)

            <div class="col- border info">{{ $cotizacion->id }}</div>
            <div class="col- border info">{{ $cotizacion->nombres_cotizante }} {{ $cotizacion->apellidos_cotizante }}</div>
            <div class="col- border info">{{ date('d/m/Y', strtotime($cotizacion->fecha_cotizacion)) }}</div>
            <div class="col- border info">{{ $cotizacion->estado_cotizacion }}</div>

            <div class="col- border">@if($isAdmin)<a style="margin-left: 5%" class="btn btn-light" href="{{ url('cotizaciones/'.$cotizacion->id.'/edit') }}" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg></a> <a class="btn btn-light" href="{{ url('cotizaciones/'.$cotizacion->id.'/contestar') }}" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
            </svg></a>@endif <a class="btn btn-light" href="{{ url('cotizaciones/'.$cotizacion->id) }}" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg></a>@if($isAdmin)<button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$cotizacion->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
              </svg></b></button>@endif</div>
              <!-- Modal eliminar cotizacion -->
              <div class="modal fade" id="exampleModal2{{$cotizacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 28vh">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="D" id="exampleModalLabel"> Eliminar la cotización</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="alert alert-danger text-center" role="alert">
                      Esta seguro de que desea eliminar la cotizacion
                      </div>
                    </div>
                    <div class="modal-footer">
                      <form action="{{ url('cotizaciones/'.$cotizacion->id) }}" method="post">
                        @csrf
                          {{ method_field('DELETE') }}
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <input type="submit" class="btn btn-primary" value="Si">
                    </form>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          </div>
        </div>
      
        </div>
      </div>
      <div class="contenedorPaginacion">
          <p class="parrafoPaginacion">{{ $cotizaciones->links() }}</p>
      </div>
  </body>
  </html>
@endsection
