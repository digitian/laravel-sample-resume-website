<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    /** Supported non-default locales */
    public const SUPPORTED = ['en', 'de'];

    public function handle(Request $request, Closure $next): Response
    {
        $first = $request->segment(1);

        if (in_array($first, self::SUPPORTED, true)) {
            app()->setLocale($first);
        } else {
            // Default: Turkish
            app()->setLocale('tr');
        }
        
        return $next($request);
    }
}
