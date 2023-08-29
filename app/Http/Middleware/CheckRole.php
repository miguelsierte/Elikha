<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle($request, Closure $next, $role)
    {
        // Check the user's role here
        if(auth()->user()->role == $role) 
        {
            return $next($request);
        }
        abort(403, 'Unauthorized');
        
    }
}
