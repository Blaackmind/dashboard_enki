<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Acesso; // Certifique-se de que esse model existe

class RegistrarAcesso
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
        Acesso::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'rota' => $request->path(),
            'metodo' => $request->method(),
            'navegador' => $request->header('User-Agent'),
        ]);

        return $next($request);
    }
}
