<?php

namespace App\Http\Middleware;

use Closure;

class Nursing
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
        if(auth()->user()->department == 'nursing'){
            return $next($request);
        }   
         
        return redirect()->back();
    }
}
