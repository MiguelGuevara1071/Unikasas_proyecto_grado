<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\Evento;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditController extends Controller
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

    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $usuario_filter = '';
        $date_filter = '';
        $accion_filter = '';
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        if ($request->has('usuario_filter') || $request->has('accion_filter') || $request->has('date_filter')) {
            if ($request->date_filter == null) {
                $fechaActual = date("Y-m-d");
                $timestamp = strtotime($fechaActual);
                $time = $timestamp - (5 * 60 * 60);
                $date_filter = date('Y-m-d', $time);
            }else{
                $date_filter = $request->date_filter;
            }
            $usuario_filter = $request->usuario_filter;
            $accion_filter = $request->accion_filter;

            $audits = Audit::select('user_id', 'modulo', 'tipo_accion', 'fecha_accion', 'item', 'sub_item', 'users.primer_nombre as primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                ->join('users', 'user_id', '=', 'users.id')
                ->where('fecha_accion', 'like', '%' . $date_filter . '%')
                ->orWhere('user_id', '=', $usuario_filter)
                ->orWhere('tipo_accion', '=', $accion_filter)
                ->paginate(50);

        }
        // } else if ($request->has('usuario_filter') && $request->has('accion_filter')) {
        //     $usuario_filter = $request->usuario_filter;
        //     $accion_filter = $request->accion_filter;

        //     $audits = Audit::select('user_id', 'modulo', 'tipo_accion', 'fecha_accion', 'item', 'sub_item', 'users.primer_nombre as primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
        //         ->join('users', 'user_id', '=', 'users.id')
        //         ->where('user_id', '=', $usuario_filter)
        //         ->where('tipo_accion', '=', $accion_filter)
        //         ->orderBy('fecha_accion', 'desc')
        //         ->paginate(50);

        // } else if ($request->has('accion_filter') && $request->has('date_filter')) {
        //     if ($request->date_filter == null) {
        //         $fechaActual = date("Y-m-d");
        //         $timestamp = strtotime($fechaActual);
        //         $time = $timestamp - (5 * 60 * 60);
        //         $date_filter = date('Y-m-d', $time);
        //     }else{
        //         $date_filter = $request->date_filter;
        //     }
        //     $accion_filter = $request->accion_filter;

        //     $audits = Audit::select('user_id', 'modulo', 'tipo_accion', 'fecha_accion', 'item', 'sub_item', 'users.primer_nombre as primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
        //         ->join('users', 'user_id', '=', 'users.id')
        //         ->where('tipo_accion', '=', $accion_filter)
        //         ->where('fecha_accion', 'like', '%' . $date_filter . '%')
        //         ->paginate(50);
        // }
        else {
            $audits = Audit::select('user_id', 'modulo', 'tipo_accion', 'fecha_accion', 'item', 'sub_item', 'users.primer_nombre as primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                ->join('users', 'user_id', '=', 'users.id')
                ->orderBy('fecha_accion', 'desc')
                ->paginate(50);
        }

        $autors = DB::select('SELECT DISTINCT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, users.id as usuario FROM users LEFT JOIN audits ON audits.user_id = users.id WHERE users.id = audits.user_id');
        return view('auditoria.moduloAuditoriaInicio', compact('audits', 'autors', 'notificaciones', 'eventosDelDiaHoy'));
    }

    public function reporteAuditoria(Request $request)
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

        if($privilegios->contains('nombre_privilegio', 'Consultar auditoria')){
            $isAdmin = true;
        }

        if($isAdmin){
            $auditoriaNombre = $request->get('searchBar');
            if($auditoriaNombre){
                $auditoria = DB::select('SELECT audits.id, modulo, tipo_accion, fecha_accion, item, sub_item, users.primer_nombre as primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits
                                LEFT JOIN users ON user_id = users.id
                                WHERE primer_nombre LIKE "%' .$auditoriaNombre. '%"
                                ORDER BY fecha_accion ASC');

            } else {
                $auditoria = DB::select('SELECT audits.id, modulo, tipo_accion, fecha_accion, item, sub_item, users.primer_nombre as primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits LEFT JOIN users ON user_id = users.id ORDER BY fecha_accion ASC');
            }

            $auditoriaFechaI = $request->get('fechaInicial');
            $auditoriaFechaF = $request->get('fechaFinal');

            if($auditoriaFechaI){
                $auditoria = DB::select('SELECT audits.id, modulo, tipo_accion, fecha_accion, item, sub_item, users.primer_nombre as primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits
                                LEFT JOIN users ON user_id = users.id
                                WHERE fecha_accion like "'.$auditoriaFechaI.'%"
                                ORDER BY fecha_accion ASC');
            }

            if($auditoriaFechaI and $auditoriaFechaF){
                $auditoria = DB::select('SELECT audits.id, modulo, tipo_accion, fecha_accion, item, sub_item, users.primer_nombre as primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits
                                LEFT JOIN users ON user_id = users.id
                                WHERE fecha_accion >= "'.$auditoriaFechaI.'%" AND fecha_accion <= "'.$auditoriaFechaF.'%"
                                ORDER BY fecha_accion ASC');
            }

            $auditPnombTable = $request->get('primer_nombre');
            $auditSnombTable = $request->get('segundo_nombre');
            $auditPapellTable = $request->get('primer_apellido');
            $auditSapellTable = $request->get('segundo_apellido');
            $auditModuloTable = $request->get('modulo');
            $auditAccionTable = $request->get('tipo_accion');
            $auditItemTable = $request->get('item');
            $auditSubItemTable = $request->get('sub_item');
            $auditFechaTable = $request->get('fecha_accion');

            $arreglo = [];
            $arreglo[] = 'primer_nombre';
            $arreglo[] = 'primer_apellido';
            if($auditPnombTable){
                $arreglo[] = $auditPnombTable;
            }
            if($auditSnombTable){
                $arreglo[] = $auditSnombTable;
            }
            if($auditPapellTable){
                $arreglo[] = $auditPapellTable;
            }
            if($auditSapellTable){
                $arreglo[] = $auditSapellTable;
            }
            if($auditModuloTable){
                $arreglo[] = $auditModuloTable;
            }
            if($auditAccionTable){
                $arreglo[] = $auditAccionTable;
            }
            if($auditAccionTable){
                $arreglo[] = $auditAccionTable;
            }
            if($auditItemTable){
                $arreglo[] = $auditItemTable;
            }
            if($auditItemTable){
                $arreglo[] = $auditItemTable;
            }
            if($auditSubItemTable){
                $arreglo[] = $auditSubItemTable;
            }
            if($auditFechaTable){
                $arreglo[] = $auditFechaTable;
            }

            if($arreglo and $auditPnombTable){
                $campos = '';
                foreach($arreglo as $valor){
                    $campos .= ", `" .$valor. "`";
                }
                $auditoria = DB::select('SELECT audits.id' .$campos. ' FROM audits LEFT JOIN users ON user_id = users.id;');
            }
            // dd($auditoria);
            return view('auditoria.crearReporteAuditoria', compact('auditoria', 'notificaciones', 'eventosDelDiaHoy'));
        } else {
            return redirect()->back();
        }
    }

    public function exportPdfAuditoria(Request $request)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Consultar auditoria')){
            $isAdmin = true;
        }

        if($isAdmin){
            $auditoria = DB::select('SELECT user_id, modulo, tipo_accion, fecha_accion, item, sub_item, users.primer_nombre as primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits LEFT JOIN users ON user_id = users.id ORDER BY fecha_accion ASC');
            // return dd($proyectos);
            $auditoria = compact('auditoria');
            $pdf = Pdf::loadView('auditoria.exportPdf', $auditoria);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteAuditoria.pdf');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
