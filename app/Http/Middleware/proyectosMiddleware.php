<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class proyectosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Traer los proyectos del usuario logueado
        $proyectos = \App\Models\Proyecto::where('encargado_id', $request->user()->id)->orWhere('cliente_id', $request->user()->id)->get();

        $rol = $request->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if (count($proyectos) > 0 || $privilegios->contains('nombre_privilegio', 'Administrar proyectos') || $privilegios->contains('nombre_privilegio', 'Consultar proyectos')) {
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
