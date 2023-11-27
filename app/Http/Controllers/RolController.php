<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use App\Models\Audit;
use App\Models\Cotizacion;
use App\Models\Evento;

class RolController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isAdmin = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar roles')){
            $isAdmin = true;
        }

        if($request->has('search')){
            $roles = Rol::where('nombre_rol', 'LIKE', '%'.$request->search.'%')->paginate(10);
        }else{
            $roles = Rol::paginate(10);
        }
        return view('roles.inicioRoles', compact('roles', 'isAdmin', 'notificaciones', 'eventosDelDiaHoy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $eventosDelDiaHoy = $this->eventosDia(auth()->user());

        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isAdmin = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar roles')){
            $isAdmin = true;
        }

        if($isAdmin){
            $privilegios = DB::select('SELECT * FROM privilegios');
            return view('roles.crearRol', compact('privilegios', 'notificaciones', 'eventosDelDiaHoy'));
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
        $privilegiosSelected = request()->except(['_token', '_method']);
        $nombreRol = $privilegiosSelected['nombre_rol'];
        $nombreRol = '"'.$nombreRol.'"';

        DB::select('INSERT INTO rols (nombre_rol) values(' .$nombreRol. ');' );

        $id = Rol::max('id');

        $data = $privilegiosSelected['privilegios'];
        foreach ($data as $privilegio) {
            DB::select('INSERT INTO rol_privilegios(rol_id, privilegio_id) VALUES (' .$id. ',' .$privilegio. ');');
        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'rol',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $nombreRol
        ]);

        return redirect('roles');
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

        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isAdmin = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar roles')){
            $isAdmin = true;
        }

        $rol = Rol::find($id);
        $privilegios = DB::select('SELECT * FROM privilegios INNER JOIN rol_privilegios ON privilegios.id = rol_privilegios.privilegio_id WHERE rol_privilegios.rol_id = ?', [$id]);
        return view('roles.verRol', compact('rol', 'privilegios', 'isAdmin', 'notificaciones', 'eventosDelDiaHoy'));
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

        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isAdmin = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar roles')){
            $isAdmin = true;
        }

        if($isAdmin){
            $rol = Rol::find($id);

            $privilegios = DB::select('SELECT * FROM privilegios INNER JOIN rol_privilegios ON privilegios.id = rol_privilegios.privilegio_id WHERE rol_privilegios.rol_id = ?', [$id]);
            $privilegiosNoAsignados = DB::select('SELECT * FROM privilegios WHERE privilegios.id NOT IN (SELECT privilegio_id FROM rol_privilegios WHERE rol_privilegios.rol_id = ?)', [$id]);
            return view('roles.modificarRol', compact('rol', 'privilegios', 'privilegiosNoAsignados', 'notificaciones', 'eventosDelDiaHoy'));
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
        DB::select('DELETE FROM rol_privilegios WHERE rol_id = ' .$id);
        $privilegiosSelected = request()->except(['_token', '_method']);
        $nombreRol = $privilegiosSelected['nombre_rol'];
        $nombreRol = '"'.$nombreRol.'"';
        $data = $privilegiosSelected['privilegios'];
        foreach ($data as $privilegio) {
            DB::select('INSERT INTO rol_privilegios(rol_id, privilegio_id) VALUES (' .$id. ',' .$privilegio. ');');
        }

        DB::select('UPDATE rols
                    SET nombre_rol =' .$nombreRol.
                    'WHERE id =' .$id);


        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);
        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'rol',
            'tipo_accion' => "modificacion",
            'fecha_accion' => $fechaActual,
            'item' => $nombreRol
        ]);

        return redirect('roles/'. $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
