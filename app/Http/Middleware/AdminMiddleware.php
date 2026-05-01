<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isStaff()) {
            return redirect()->route('home')
                ->with('error', 'Acceso denegado. Se requieren permisos de staff.');
        }

        return $next($request);
    }
}
