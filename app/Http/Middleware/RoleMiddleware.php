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
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'Guest')
    {
        // Jika peran adalah 'Guest', izinkan akses tanpa login
        if ($role === 'Guest') {
            return $next($request);
        }

        // Jika pengguna tidak login dan bukan 'Guest', redirect ke login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek apakah pengguna memiliki peran yang diizinkan
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
    
}

