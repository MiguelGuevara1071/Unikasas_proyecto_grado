<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class usuariosMiddleware
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
            $email = $request->user()->email;
            if($email != ''){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('index');
        }
    }
}
