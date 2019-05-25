<?php

namespace App\Http\Middleware;

use Closure;

class Treatment
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
        if(auth()->user()->department == 'treatment'){
            return $next($request);
        }
        
        return redirect()->back();
    }
}
