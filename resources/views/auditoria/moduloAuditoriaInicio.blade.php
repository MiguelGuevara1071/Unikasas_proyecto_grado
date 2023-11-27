@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/auditoria/moduloAuditoria.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Proyectos Unikasas Auditoria</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <main class="workspace">
            <h1 class="titleModule">Registro de auditoria</h1>
            <form class="searchForm" action="{{ url('auditoria') }}" method="GET">
                Busqueda: <input type="text" class="input-text" id="filter" onkeyup="filterdata()">
            </form>
            <div class="container">
                <aside>
                    <div class="button">
                        <a class="buttonCreateReporte" href="{{ url('/reporteAuditoria') }}">Crear reporte</a>
                    </div>
                </aside>
                <main class="auditoria">
                    <table class="tableAudit">
                        <thead>
                            <tr>
                                <th>Autor</th>
                                <th>Modulo</th>
                                <th>Acción</th>
                                <th>Item Afectado</th>
                                <th>Sub Item</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($audits as $audit)
                            <tr class="tr">
                                <td>{{ $audit->primer_nombre }} {{ $audit->segundo_nombre }} {{ $audit->primer_apellido }} {{ $audit->segundo_apellido }}</td>
                                <td>{{ $audit->modulo }}</td>
                                <td>{{ $audit->tipo_accion }}</td>
                                <td>{{ $audit->item }}</td>
                                <td>{{ $audit->sub_item }}</td>
                                <td>{{ $audit->fecha_accion }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="contenedorpaginacion">
                        <p class="parrafoPaginacion">{{ $audits->links() }}</p>
                    </div>
                </main>
            </div>

        </main>
        <script src="{{ asset('js/auditoria/filter.js') }}"></script>
    </body>
    </html>

@endsection
