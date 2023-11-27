<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class auditMiddleware
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
        $user = \Auth::user();
        if($user){

            $rol = $request->user()->rol_id;
            $privilegios = \DB::table('rol_privilegios')
                ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
                ->select('privilegios.nombre_privilegio')
                ->where('rol_privilegios.rol_id', '=', $rol)
                ->get();

            $isAdmin = false;

            if ($privilegios->contains('nombre_privilegio', 'Consultar auditoria')) {
                $isAdmin = true;
            }

            if ($isAdmin) {
                return $next($request);
            } else {
                return redirect()->back();
            }
        }else{
            return redirect('index');
        }
    }
}
