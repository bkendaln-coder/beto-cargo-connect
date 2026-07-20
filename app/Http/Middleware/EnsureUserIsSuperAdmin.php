<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'super_admin',
            403,
            'Accès réservé au super administrateur.'
        );

        return $next($request);
    }
}