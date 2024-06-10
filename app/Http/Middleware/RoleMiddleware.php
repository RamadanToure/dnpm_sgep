<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté et a l'un des rôles spécifiés
        if (!Auth::check() || !Auth::user()->hasAnyRole($roles)) {
            abort(403, 'Accès interdit');
        }

        return $next($request);
    }
}
