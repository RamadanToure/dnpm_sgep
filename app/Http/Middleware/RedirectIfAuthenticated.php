<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $redirectPath = $this->getRedirectPathForUser($user);
            return redirect($redirectPath);
        }

        return $next($request);
    }

    protected function getRedirectPathForUser($user)
    {
        if (property_exists($user, 'role')) {
            switch ($user->role) {
                case 'admin':
                    return '/admin/dashboard';
                case 'user':
                    return '/user/dashboard';
                case 'agent':
                    return '/agent/dashboard';
            }
        }

        return '/home'; // Défaut si aucun rôle correspondant ou si la propriété $user->role n'existe pas
    }
}
