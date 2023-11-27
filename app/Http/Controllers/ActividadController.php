<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\DB;
use App\Models\actividadEtapa;
use App\Models\Audit;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $datosActividad = request()->except('_token', 'etapa_id');
        Actividad::insert($datosActividad);
        $idActividad = Actividad::max('id');

        $nombreProyecto = DB::select('SELECT nombre_proyecto FROM proyectos LEFT JOIN proyecto_etapas ON proyecto_id = proyectos.id WHERE etapa_id = ?', [$request->etapa_id]);
        $nombreProyecto = $nombreProyecto[0]->nombre_proyecto;

        actividadEtapa::insert([
            'actividad_id' => $idActividad,
            'etapa_id' => $request->etapa_id,
        ]);

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => 1,
            'modulo' => 'actividad',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosActividad['nombre_actividad'],
            'sub_item' => $nombreProyecto,
        ]);

        return redirect('/actividades/' .$idActividad);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = auth()->user()->id;
        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isAdmin = $privilegios->contains('nombre_privilegio', 'Administrar proyectos');
        $isConsultar = $privilegios->contains('nombre_privilegio', 'Consultar proyectos');
        $isMe = false;

        //Obtener el proyecto al que pertenece la actividad. Para obtenerlo se debe tener en cuentas las tablas: proyectos, proyecto_etapas, etapas, actividad_etapas
        $proyecto = DB::select('SELECT * FROM proyectos
                                INNER JOIN proyecto_etapas ON proyecto_id = proyectos.id
                                INNER JOIN etapas ON etapa_id = etapas.id
                                INNER JOIN actividad_etapas ON actividad_etapas.etapa_id = etapas.id
                                WHERE actividad_etapas.actividad_id = ?', [$id]);

        //$proyecto = DB::select('SELECT * FROM proyectos LEFT JOIN proyecto_etapas ON proyecto_id = proyectos.id LEFT JOIN etapas ON etapas.id = etapa_id LEFT JOIN actividad_etapas ON actividad_etapas.etapa_id = etapas.id WHERE actividad_etapas.actividad_id = ?', [$id]);
        $cliente = $proyecto[0]->cliente_id;


        if($cliente == $userId){
            $isMe = true;
        }

        if($isAdmin || $isConsultar || $isMe){
            $actividad = Actividad::find($id);
            return view('proyectos.viewActivity', compact('actividad'));
        }else{
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
        $rol = auth()->user()->rol_id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $proyecto = DB::select('SELECT * FROM proyectos
            INNER JOIN proyecto_etapas ON proyecto_id = proyectos.id
            INNER JOIN etapas ON etapa_id = etapas.id
            INNER JOIN actividad_etapas ON actividad_etapas.etapa_id = etapas.id
            WHERE actividad_etapas.actividad_id = ?', [$id]);

        $isAdmin = $privilegios->contains('nombre_privilegio', 'Administrar proyectos');
        $isEncargado = false;

        if($proyecto[0]->encargado_id == auth()->user()->id){
            $isEncargado = true;
        }

        if($isAdmin || $isEncargado){
            $actividad = Actividad::find($id);
            return view('proyectos.editActivity', compact('actividad'));
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
        $datosActividad = request()->except(['_token', '_method']);

        Actividad::where('id', '=', $id)->update($datosActividad);

        $nombreProyecto = DB::select('SELECT nombre_proyecto
                                    FROM proyectos
                                    INNER JOIN proyecto_etapas ON proyectos.id = proyecto_id
                                    INNER JOIN etapas ON proyecto_etapas.etapa_id = etapas.id
                                    INNER JOIN actividad_etapas ON actividad_etapas.etapa_id = etapas.id
                                    INNER JOIN actividads ON actividad_etapas.actividad_id = actividads.id
                                    WHERE actividads.id =' .$id);
        $nombreProyecto = $nombreProyecto[0]->nombre_proyecto;

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => 1,
            'modulo' => 'actividad',
            'tipo_accion' => "modificacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosActividad['nombre_actividad'],
            'sub_item' => $nombreProyecto,
        ]);

        return redirect('/actividades/'.$id);
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
