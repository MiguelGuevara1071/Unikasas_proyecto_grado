<?php

namespace App\Http\Controllers;

use App\Mail\emailCancelarEvento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Proyecto;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cotizacion;

use Illuminate\Support\Facades\Mail;
use App\Mail\emailCrearEvento;
use App\Mail\emailNotificacionEvento;

class EventoController extends Controller
{
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
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $eventosFinalizados = $this->finalizarEstadoEvento();

        $rol = $request->user()->rol_id;
        $email = $request->user()->email;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar eventos') || $privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            // variables para los filtros de busqueda
            $eventoBusqueda = $request->get('searchBar');
            $campoTabla = $request->get('campoBusqueda');

            if($eventoBusqueda != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->where('nombre_evento', 'like', "%$eventoBusqueda%")
                                ->paginate(10);
            } else {
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->orderBy('eventos.id', 'DESC')
                                ->paginate(10);
            }

            if($eventoBusqueda != '' && $campoTabla != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->where($campoTabla, 'like', "%$eventoBusqueda%")
                                ->paginate(10);
            }
        }else{
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->where('invitados_evento', 'like', "%$email%")
                                ->orderBy('eventos.id', 'DESC')
                                ->paginate(10);
        }

        return view('Eventos.indexEventos', compact('eventos', 'isAdmin', 'notificaciones', 'eventosDelDiaHoy'));
    }

    public function create()
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

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if ($isAdmin) {
            // variable proyectos para mostrar los proyectos existentes en el formulario de creacion
            $proyectos = DB::table('proyectos')
                            ->where('estado_proyecto', '=', 'En ejecución')
                            ->get();
            return view('Eventos.formCrearEvento', compact('proyectos', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except('_token');
        $email= request('invitados_evento');
        $emailSeparado = explode(',', $email);
        Evento::insert($datosEvento);

        if($email){
            foreach($emailSeparado as $email){
                Mail::to($email)->send(new emailCrearEvento($datosEvento));
            }
        }

        return redirect('eventos')->with('mensaje', 'El evento se agrego exitosamente');
    }

    public function show($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $email = auth()->user()->email;
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $isMember = false;
        $canView = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $canView = true;
        }

        $evento = Evento::findOrfail($id);

        //Si el evento contiene el $email dentro del campo invitados_evento
        if(strpos($evento->invitados_evento, $email) !== false){
            $isMember = true;
        }

        if($isAdmin || $isMember || $canView){
            // variable proyecto para acceder al proyecto al cual se encuentra asignado el evento
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);
            return view('Eventos.visualizarEvento', compact('evento', 'proyecto', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }

    }

    public function edit($id)
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

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if ($isAdmin) {
            $evento = Evento::findOrfail($id);
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);
            return view('Eventos.modificarEvento', compact('evento','proyecto', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $datosEvento = request()->except(['_token','_method', "eventName", "eventDate", "eventTime", "eventProyect", "eventAssistant", "eventReason"]);
        
        Evento::where('id', '=', $id)->update($datosEvento);

        $respuesta = request('eventReason');
    
        if($respuesta){
            $datos = request()->except(['_token','_method']);
            $email= request('eventAssistant');
            $emailSeparado = explode(', ', $email);
            foreach($emailSeparado as $email){
                Mail::to($email)->send(new emailCancelarEvento($datos));
            }
        }
        // $evento = Evento::findOrFail($id);
        return redirect('eventos')->with('mensaje', 'El evento ha sido modificado');
    }

    public function cancel($id)
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

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $evento = Evento::findOrfail($id);
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);

            return view('Eventos.formCancelarEvento', compact('evento','proyecto', 'notificaciones', 'eventosDelDiaHoy'));
        }else{
            return redirect()->back();
        }
    }

    public function disponibilidad(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $fechaInicial = $request->get('fecha');
        $fechaFinal = $request->get('fechaDos');

        if($fechaInicial != ''){
            // dd($fechaInicial);
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->where('fecha_evento', 'like', "$fechaInicial")
                                ->paginate(10);
        } else {
            $eventos = Evento::paginate(10);
        }

        if($fechaInicial != '' && $fechaFinal != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->whereDate('fecha_evento', '>=', "$fechaInicial")
                                ->whereDate('fecha_evento', '<=', "$fechaFinal")
                                ->paginate(10);
        }
        return view('Eventos.disponibilidad', compact('eventos', 'notificaciones'));
    }

    public function verDisponibilidad(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());
        $fecha = $request->get('fecha');
        if($fecha != ''){
            $nuevafecha = explode('/', $fecha);
            $dia = $nuevafecha[1];
            $mes = $nuevafecha[0];
            $annio = $nuevafecha[2];
            $fecha = $annio."-".$mes."-".$dia;

            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->where('fecha_evento', 'like', "$fecha")
                                ->get();

            $fechaInicial = $annio."-".$mes."-01";
            $fechaFinal = $annio."-".$mes."-31";

            $eventosMes = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->whereDate('fecha_evento', '>=', "$fechaInicial")
                                ->whereDate('fecha_evento', '<=', "$fechaFinal")
                                ->get();

            return view('Eventos.verDisponibilidad', compact('eventos', 'eventosMes', 'notificaciones', 'eventosDelDiaHoy'));
        } else {
            $eventos = Evento::where('fecha_evento', '=', date('Y-m-d'));
            return view('Eventos.verDisponibilidad', compact('eventos', 'notificaciones', 'eventosDelDiaHoy'));
        }
    }

    public function reporteEventos(Request $request)
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

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $eventoNombre = $request->get('searchBar');

            $eventoFechaI = $request->get('fechaInicial'); // variables para el filtro de creacion del reporte
            $eventoFechaF = $request->get('fechaFinal');

            if($eventoNombre != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                    ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                    ->where('nombre_evento', 'like', "%$eventoNombre%")
                                    ->get();
            } else {
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                    ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                    ->get();
            }

            if($eventoFechaI != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                    ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                    ->where('fecha_evento', 'like', "%$eventoFechaI%")
                                    ->get();
            }

            if($eventoFechaI != '' && $eventoFechaF != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                    ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                    ->whereDate('fecha_evento', '>=', "$eventoFechaI%")
                                    ->whereDate('fecha_evento', '<=', "$eventoFechaF%")
                                    ->get();
            }

            // filtro campos checkbox
            $eventoNombTable = $request->get('nombre_evento');
            $eventoFechTable = $request->get('fecha_evento');
            $eventoHorITable = $request->get('hora_inicio');
            $eventoHorFTable = $request->get('hora_fin');
            $eventoProyectTable = $request->get('nombre_proyecto');
            $eventoNotifTable = $request->get('notificacion_evento');
            $eventoInvitTable = $request->get('invitados_evento');
            $eventoLugTable = $request->get('lugar_evento');
            $eventoAsuntTable = $request->get('asunto_evento');
            $eventoMensajTable = $request->get('mensaje_evento');
            $eventoEstadTable = $request->get('estado_evento');

            $arreglo = [];
            $arreglo[] = 'nombre_evento';
            if($eventoNombTable){
                $arreglo[] = $eventoNombTable;
            }
            if($eventoFechTable){
                $arreglo[] = $eventoFechTable;
            }
            if($eventoHorITable){
                $arreglo[] = $eventoHorITable;
            }
            if($eventoHorFTable){
                $arreglo[] = $eventoHorFTable;
            }
            if($eventoProyectTable){
                $arreglo[] = $eventoProyectTable;
            }
            if($eventoNotifTable){
                $arreglo[] = $eventoNotifTable;
            }
            if($eventoInvitTable){
                $arreglo[] = $eventoInvitTable;
            }
            if($eventoLugTable){
                $arreglo[] = $eventoLugTable;
            }
            if($eventoAsuntTable){
                $arreglo[] = $eventoAsuntTable;
            }
            if($eventoMensajTable){
                $arreglo[] = $eventoMensajTable;
            }
            if($eventoEstadTable){
                $arreglo[] = $eventoEstadTable;
            }

            if($arreglo and $eventoNombTable){
                $campos = '';
                foreach($arreglo as $valor){
                    $campos .= ", `" .$valor. "`";
                }
                $eventos = DB::select('SELECT eventos.id' .$campos. ' FROM eventos INNER JOIN proyectos on eventos.proyecto_id = proyectos.id;');
            }

            return view('Eventos.crearReporteEvent', compact('eventos', 'notificaciones', 'eventosDelDiaHoy'));

        }else{
            return redirect()->back();
        }

    }

    public function exportPdfEventos()
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')
                                ->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')
                                ->get();
            $eventos = compact('eventos');
            $pdf = Pdf::loadView('Eventos.exportPdf', $eventos);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteEventos.pdf');
        }else{
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            Evento::destroy($id);
            return redirect('eventos')->with('mensage','El evento ha sido borrado');
        }else{
            return redirect()->back();
        }
    }

    public function finalizarEstadoEvento(){
        // Finalizar el estado del evento una vez se pase de la fecha del mismo
        $eventos = Evento::all()->where('estado_evento', '=', 'Activo');
        $diaActual = date("d");
        $mesActual = date("m");
        $annioActual = date("Y");
        $datos = (['estado_evento' => 'Finalizado']);
        foreach($eventos as $evento){
            $eventoDia = date('d', strtotime($evento->fecha_evento));
            $eventoMes = date('m', strtotime($evento->fecha_evento));
            $eventoAnnio = date('Y', strtotime($evento->fecha_evento));
            $id = $evento->id;
            if($diaActual > $eventoDia AND $mesActual == $eventoMes AND $annioActual == $eventoAnnio){
                Evento::where('id', '=', $id)->update($datos);
            }
            $eventosNotificacion = $this->enviarNotificaciónEvento();
        }                  
    }

    public function enviarNotificaciónEvento(){
        // Enviar la notificación del evento segun la hora programada para el mismo
        $eventos = Evento::all()->where('estado_evento', '=', 'Activo');
        $diaActual = date('d');
        $mesActual = date('m');
        $annioActual = date('Y');
        $horaActual = date('h') - 5;
        $minutosActuales = date('i');
        $horarioActual = date('A');
        $contador = 1;
        foreach($eventos as $evento){

            $eventoDia = date('d', strtotime($evento->fecha_evento));
            $eventoMes = date('m', strtotime($evento->fecha_evento));
            $eventoAnnio = date('Y', strtotime($evento->fecha_evento));
            
            if($diaActual == $eventoDia AND $mesActual == $eventoMes AND $annioActual == $eventoAnnio){
                $horaEvento = date('h', strtotime($evento->hora_inicio));
                $minutosEvento = date('i', strtotime($evento->hora_inicio));
                $horarioEvento = date('A', strtotime($evento->hora_inicio));
               
                if($horaActual <= $horaEvento AND $horarioActual == $horarioEvento){
                    $horaNotificacion = intval($horaEvento) - intval($horaActual);
                    $minutosNotificacion = intval($minutosActuales) - intval($minutosEvento);
                
                    if($horaNotificacion == 1 AND $minutosNotificacion = 0){
                        $email= $evento->invitados_evento;
                        // dd($email);
                        $emailSeparado = explode(', ', $email);
                        foreach($emailSeparado as $email){
                            Mail::to($email)->send(new emailNotificacionEvento($evento));
                        }
                    }
                    
                }
            }
        } 
    }

}
