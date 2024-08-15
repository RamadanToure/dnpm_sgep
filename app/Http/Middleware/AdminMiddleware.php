<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if (auth()->user() && auth()->user()->hasRole('admin')) {
    //         return $next($request);
    //     }

    //     // Rediriger vers une route spécifique pour une action d'interdiction d'accès
    //     return redirect()->route('login')->with('error', 'Accès non autorisé.');
    // }
}
