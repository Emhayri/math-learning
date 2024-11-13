<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if there is a 'locale' set in the session
        if (session()->has('locale')) {
            // Set the application locale to the session locale
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
