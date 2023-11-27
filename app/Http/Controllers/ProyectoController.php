<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Actividad;
use App\Models\ProyectoEtapa;
use App\Models\Etapa;
use App\Models\Audit;
use App\Models\Cotizacion;
use App\Models\Evento;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\Paginator;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeNotifications($userId){
        $rol = $userId->rol_id;
        $email = $userId->email;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isCotizacionAdmin = false;
        $isEventoAdmin = false;
        if($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones') || $privilegios->contains('nombre_privilegio', 'Consultar cotizaciones')){
            $isCotizacionAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos') || $privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $isEventoAdmin = true;
        }

        if($isCotizacionAdmin && $isEventoAdmin){
            $cotizaciones = Cotizacion::where('estado_cotizacion', '=', 'Por responder')->get();
            $numCotizaciones = $cotizaciones->count();
            $eventos = Evento::where('fecha_evento', '=', date('Y-m-d'))->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
            if ($numCotizaciones > 0) {
                $notificaciones[] = array('tipo' => 'Cotizaciones', 'cantidad' => $numCotizaciones);
            }

        }else{
            $eventos = Evento::where('invitados_evento', 'like', "%$email%")->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
        }


        return $notificaciones;
    }

    public function eventosDia($userId)
    {
        $email = $userId->email;
        if($email){
            $eventosDelDia = Evento::where('invitados_evento', 'like', "%$email%")
                                    ->where('fecha_evento', '=', date('Y-m-d'))
                                    ->get();
        } else {
            $eventosDelDia = null;
        }
        return $eventosDelDia;
    }

    public function index(Request $request, $estado)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        if ($estado == 'activo') {
            $estadoFind = "En ejecución";
            $estadoFind2 = "En ejecución";
        }elseif ($estado == 'inactivo') {
            $estadoFind = "Suspendido";
            $estadoFind2 = "Finalizado";
        }

        $rol = $request->user()->rol_id;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();


        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos')) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }


        if($privilegios->contains(function ($value) {
            return $value->nombre_privilegio == 'Consultar proyectos';
        }) || $privilegios->contains(function ($value) {
            return $value->nombre_privilegio == 'Administrar proyectos';
        })){

            if($request->has('search') && $request->has('filtro')){
                if (!isset($request->filtro)) {
                    $request->filtro = 'estado_proyecto';
                } elseif (!isset($request->search)) {
                    $request->search = '';
                }

                $proyectos = Proyecto::where('nombre_proyecto', 'LIKE', '%'.$request->search.'%')
                ->join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
                ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
                ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
                ->orWhere('encargado.primer_nombre', 'LIKE', '%'.$request->search.'%')
                ->orWhere('cliente.primer_nombre', 'LIKE', '%'.$request->search.'%')
                ->orWhere('encargado.primer_apellido', 'LIKE', '%'.$request->search.'%')
                ->orWhere('cliente.primer_apellido', 'LIKE', '%'.$request->search.'%')
                ->orderby($request->filtro)
                ->paginate(20);

                foreach ($proyectos as $proyecto) {
                    $producto = $proyecto->producto_id;
                    $imagen = DB::select('SELECT image.path
                                        FROM image
                                        INNER JOIN product_image ON product_image.image_id = image.id
                                        INNER JOIN productos ON productos.id = product_image.producto_id
                                        WHERE productos.id = ' .$producto);

                    if(empty($imagen)){
                        $imagen = 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200';
                    }else{
                        $imagen = $imagen[0]->path;
                    }
                    $proyecto->image = $imagen;
                }
            }else{

                $proyectos = Proyecto::where('estado_proyecto', '=', $estadoFind)
                    ->orWhere('estado_proyecto', '=', $estadoFind2)
                    ->join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
                    ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
                    ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
                    ->orderby('fecha_inicio', 'desc')
                    ->paginate(20);

                foreach ($proyectos as $proyecto) {
                    //Traer la imagen del producto del proyecto. Join de la tabla proyectos con la tabla productos. Join de la tabla productos con la tabla product_image. Join de la tabla product_image con la tabla image.
                    $producto = $proyecto->producto_id;
                    $imagen = DB::select('SELECT image.path
                                        FROM image
                                        INNER JOIN product_image ON product_image.image_id = image.id
                                        INNER JOIN productos ON productos.id = product_image.producto_id
                                        WHERE productos.id = ' .$producto);

                    if(empty($imagen)){
                        $imagen = 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200';
                    }else{
                        $imagen = $imagen[0]->path;
                    }
                    $proyecto->image = $imagen;
                }
            }
        }
        else{

            $proyectos = Proyecto::where('estado_proyecto', '=', $estadoFind)
            ->where('cliente_id', '=', $request->user()->id)
            ->orWhere('encargado_id', '=', $request->user()->id)
            ->join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
            ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
            ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
            ->orderby('fecha_inicio', 'desc')
            ->paginate(5);

            foreach ($proyectos as $proyecto) {
                $producto = $proyecto->producto_id;
                $imagen = DB::select('SELECT image.path
                                    FROM image
                                    INNER JOIN product_image ON product_image.image_id = image.id
                                    INNER JOIN productos ON productos.id = product_image.producto_id
                                    WHERE productos.id = ' .$producto);
                $proyecto->image = $imagen[0]->path;
            }
        }
        $notificaciones = $this->makeNotifications(auth()->user());
        return view('proyectos.moduloInicioProyecto', compact('proyectos', 'isAdmin', 'notificaciones', 'eventosDelDiaHoy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $rol = $request->user()->rol_id;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos') || $privilegios->contains('nombre_privilegio', 'Dirigir proyectos')) {
            $encargados = DB::select('SELECT users.id, users.primer_nombre, users.segundo_nombre, users.primer_apellido, users.segundo_apellido
                                    FROM users
                                    LEFT JOIN rols ON rols.id = users.rol_id
                                    WHERE rols.nombre_rol LIKE"%min%"');
            $clientes = DB::select('SELECT users.id, users.primer_nombre, users.segundo_nombre, users.primer_apellido, users.segundo_apellido
                                    FROM users
                                    LEFT JOIN rols ON rols.id = users.rol_id
                                    WHERE rols.nombre_rol LIKE "%liente"');
            $productos = DB::select('SELECT productos.id, productos.nombre_producto, productos.descripcion_producto, productos.precio_producto
                                    FROM productos');

            return view('proyectos.crearProyecto', compact('encargados', 'clientes', 'productos', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProyecto = request()->except('_token');
        $product = $datosProyecto['producto_id'];

        $str = $datosProyecto['cliente_id'];
        $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

        $datosProyecto['cliente_id'] = $int;

        Proyecto::insert($datosProyecto);
        $idProyecto = Proyecto::max('id');

        Etapa::insert([
            'nombre_etapa' => 'Planeación, diseño y estructuración',
            'descripcion_etapa' => 'Fase 1',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Compra y alistamiento de materiales esenciales',
            'descripcion_etapa' => 'Fase 2',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Transporte',
            'descripcion_etapa' => 'Fase 3',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Construccion',
            'descripcion_etapa' => 'Fase 4',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Entrega',
            'descripcion_etapa' => 'Fase 5',
        ]);

        $idEtapa = Etapa::max('id');

        for ($i=1; $i <= 5; $i++) {
            ProyectoEtapa::insert([
                'proyecto_id' => $idProyecto,
                'etapa_id' => $idEtapa]);
            $idEtapa--;
        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'proyecto',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosProyecto['nombre_proyecto']
        ]);

        header('Location: http://127.0.0.1:8000/proyectos/search/activo');

        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $idEncargado = Proyecto::select('encargado_id')->where('id', '=', $id)->get();
        $idCliente = Proyecto::select('cliente_id')->where('id', '=', $id)->get();
        $userId = auth()->user()->id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', auth()->user()->rol_id)
            ->get();

        if ($idEncargado[0]->encargado_id == $userId || $privilegios->contains('nombre_privilegio', 'Administrar proyectos') && $userId != $idCliente[0]->cliente_id) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        if ($userId == $idEncargado[0]->encargado_id || $userId == $idCliente[0]->cliente_id) {
            $isMember = true;
        }else{
            $isMember = false;
        }

        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos') || $privilegios->contains('nombre_privilegio', 'Consultar proyectos')) {
            $canView = true;
        }else{
            $canView = false;
        }

        if ($isMember || $canView) {
            $proyecto = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final, proyectos.suspension_proyecto, productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id
                                WHERE proyectos.id = '.$id);

            $etapas = DB::select('SELECT etapas.id, etapas.nombre_etapa
                                from proyectos
                                INNER JOIN proyecto_etapas as pro ON proyectos.id = pro.proyecto_id
                                INNER JOIN etapas ON pro.etapa_id = etapas.id
                                WHERE proyectos.id = ' .$id. '
                                ORDER BY etapas.id ASC');

            $actividades = DB::select('SELECT actividads.id, actividads.nombre_actividad, actividads.fecha_inicio,
                                    actividads.encargado_actividad, actEtp.etapa_id as etapa_id, actEtp.actividad_id as actividad_id
                                    from actividads
                                    INNER JOIN actividad_etapas as actEtp ON actividads.id = actEtp.actividad_id
                                    INNER JOIN etapas ON actEtp.etapa_id = etapas.id
                                    ORDER BY actividads.id ASC');

            return view('proyectos.viewProyecto', compact('proyecto', 'etapas', 'actividades', 'isAdmin', 'notificaciones', 'eventosDelDiaHoy'));
        } else {
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $idEncargado = Proyecto::select('encargado_id')->where('id', '=', $id)->get();
        $idCliente = Proyecto::select('cliente_id')->where('id', '=', $id)->get();
        $userId = auth()->user()->id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', auth()->user()->rol_id)
            ->get();

        if ($idEncargado[0]->encargado_id == $userId || $privilegios->contains('nombre_privilegio', 'Administrar proyectos') && $userId != $idCliente[0]->cliente_id) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        if ($isAdmin) {
            $proyecto = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final , productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id
                                WHERE proyectos.id = '.$id);

            $etapas = DB::select('SELECT etapas.id, etapas.nombre_etapa
                                from proyectos
                                INNER JOIN proyecto_etapas as pro ON proyectos.id = pro.proyecto_id
                                INNER JOIN etapas ON pro.etapa_id = etapas.id
                                WHERE proyectos.id = ' .$id. '
                                ORDER BY etapas.id ASC');

            $actividades = DB::select('SELECT actividads.id, actividads.nombre_actividad, actividads.fecha_inicio,
                                    actividads.encargado_actividad, actEtp.etapa_id as etapa_id, actEtp.actividad_id as actividad_id
                                    from actividads
                                    INNER JOIN actividad_etapas as actEtp ON actividads.id = actEtp.actividad_id
                                    INNER JOIN etapas ON actEtp.etapa_id = etapas.id
                                    ORDER BY actividads.id ASC');

            return view('proyectos.editProyecto', compact('proyecto', 'etapas', 'actividades', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $datosProyecto = request()->except(['_token', '_method']);

        $nombreProyecto = Proyecto::findOrFail($id);
        $nombreProyecto = $nombreProyecto->nombre_proyecto;

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        $accion = $datosProyecto['accion'];

        unset($datosProyecto['accion']);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'proyecto',
            'tipo_accion' => $accion,
            'fecha_accion' => $fechaActual,
            'item' => $nombreProyecto
        ]);

        Proyecto::where('id', '=', $id)->update($datosProyecto);

        return redirect('/proyectos/' .$id);
    }

    public function reporteProyectos(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar proyectos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $nombreProyecto = $request->get('searchBar');
           if($nombreProyecto != ''){
                $proyectos = Proyecto::join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
                                ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
                                ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
                                ->where('nombre_proyecto', 'LIKE', '%'.$nombreProyecto.'%')
                                ->get();
           } else {
                $proyectos = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final, proyectos.suspension_proyecto, productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id');
           }

           $proyectoFechaI = $request->get('fechaInicial');
           $proyectoFechaF = $request->get('fechaFinal');

           if($proyectoFechaI != ''){
                $proyectos = Proyecto::join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
                                ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
                                ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
                                ->where('fecha_inicio', 'like', "%$proyectoFechaI%")
                                ->get();
            }

            if($proyectoFechaI != '' && $proyectoFechaF != ''){
                $proyectos = Proyecto::join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
                                ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
                                ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
                                ->whereDate('fecha_inicio', '>=', "$proyectoFechaI%")
                                ->whereDate('fecha_inicio', '<=', "$proyectoFechaF%")
                                ->get();
            }

            // filtro campos checkbox
            $proyectoNombTable = $request->get('nombre_proyecto');
            $proyectoEstsdTable = $request->get('estado_proyecto');
            $proyectoFechaITable = $request->get('fecha_inicio');
            $proyectoFechaFTable = $request->get('fecha_fin');
            $proyectoCiudFTable = $request->get('ciudad_proyecto');
            $proyectoDirrecciFTable = $request->get('direccion_proyecto');
            $proyectoCostoETable = $request->get('costo_estimado');
            $proyectoCostoFTable = $request->get('costo_final');
            $proyectoProductTable = $request->get('nombre_producto');
            $proyectoEncargadoTable = $request->get('encargado_nombre');
            $proyectoClienteTable = $request->get('cliente_nombre');

            $arreglo = [];
            $arreglo[] = 'nombre_proyecto';
            if($proyectoNombTable){
                $arreglo[] = $proyectoNombTable;
            } 

            if($proyectoEstsdTable){
                $arreglo[] = $proyectoEstsdTable;
            }
            if($proyectoFechaITable){
                $arreglo[] = $proyectoFechaITable;
            }
            if($proyectoFechaFTable){
                $arreglo[] = $proyectoFechaFTable;
            }
            if($proyectoFechaFTable){
                $arreglo[] = $proyectoFechaFTable;
            }
            if($proyectoCiudFTable){
                $arreglo[] = $proyectoCiudFTable;
            }
            if($proyectoDirrecciFTable){
                $arreglo[] = $proyectoDirrecciFTable;
            }
            if($proyectoCostoETable){
                $arreglo[] = $proyectoCostoETable;
            }
            if($proyectoCostoFTable){
                $arreglo[] = $proyectoCostoFTable;
            }
            if($proyectoProductTable){
                $arreglo[] = $proyectoProductTable;
            }
            if($proyectoEncargadoTable){
                // $arreglo[] = 'encargado.primer_nombre as encargado_nombre';
                // $arreglo[] = 'encargado.primer_apellido as encargado_apellido';
            }
            if($proyectoClienteTable){
                // $arreglo[] = 'cliente.primer_nombre as encargado_nombre';
                // $arreglo[] = 'cliente.primer_apellido as encargado_apellido';
            }
            if($arreglo and $proyectoNombTable){
                $campos = '';
                foreach($arreglo as $valor){
                    $campos .= ", `" .$valor. "`";
                }
                $proyectos= DB::select('SELECT proyectos.id' .$campos. ', encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id;');   
                
            }
            return view('proyectos.crearReporteProyectos', compact('proyectos', 'notificaciones', 'eventosDelDiaHoy'));
        } else {
            return redirect()->back();
        }
    }

    public function exportPdfProyectos(Request $request)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar proyectos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $proyectos = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final, proyectos.suspension_proyecto, productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id');
            $proyectos = compact('proyectos');
            $pdf = Pdf::loadView('proyectos.exportPdf', $proyectos);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteProyectos.pdf');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrfail($id);
    }
}
