<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;


class MiddlewareValidarRolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // echo "estoy en el middleware <br>";
        // dd(Auth::user());
        if (Auth::check() && Auth::user()->type==1) {
          // echo "logueado y admin";
          return $next($request);
        } elseif (Auth::check() && Auth::user()->type==0) {
          // echo "logueado e invitado";
          return redirect('/homeHassen');
        } else {
          // echo "ni logueado";
          return redirect('/register');
        }
    }
}
