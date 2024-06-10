<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // Rediriger vers une route spécifique pour une action d'interdiction d'accès
        return redirect()->route('login')->with('error', 'Accès non autorisé.');
    }
}
