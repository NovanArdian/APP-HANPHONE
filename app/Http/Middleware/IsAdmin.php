<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == "admin") {
            return $next($request);
        }else {
            return redirect()->route('landing_page')->with('failed', 'Anda bukan admin! tidak di perbolehkan untuk akses');
        }
        
    }
}
