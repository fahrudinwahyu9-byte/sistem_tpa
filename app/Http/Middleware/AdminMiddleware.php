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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === \App\Models\User::ROLE_ADMIN) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki hak akses untuk fitur ini.');
    }
}
