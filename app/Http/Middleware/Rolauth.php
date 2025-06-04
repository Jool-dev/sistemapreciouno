<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Rolauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $usuario = session('usuariologeado');

        $rol = strtolower($usuario['data'][0]['rol']);
        $roles = array_map('strtolower', $roles);

        if (!$usuario || !in_array($rol, $roles)) {
            return redirect()->route('vistadashboard')->with('error', 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
