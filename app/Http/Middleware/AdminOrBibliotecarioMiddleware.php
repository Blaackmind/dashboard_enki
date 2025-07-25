<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrBibliotecarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && ($user->isAdmin() || $user->isBibliotecario())) {
            return $next($request);
        }
        abort(403, 'Acesso não autorizado.');
    }
} 