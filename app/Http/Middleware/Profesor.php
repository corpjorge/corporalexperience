<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Profesor
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
      if (!Auth::user()->rol_id == 7 ) {
          return redirect('404');
      }

      return $next($request);
    }
}
