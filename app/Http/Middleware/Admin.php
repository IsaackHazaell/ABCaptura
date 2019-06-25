<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
      if(\Auth::User()->user_type != 'Admin')
     {
       return redirect()->back()->with([
         'mensaje' => 'Sin permisos'
       ]);
     }
     return $next($request);;
    }
}
