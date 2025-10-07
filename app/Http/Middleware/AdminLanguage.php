<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class AdminLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = session('admin_locale') ?? optional($request->user())->language ?? config('app.locale');

        if (!in_array($language, ['tr','en','de'], true)) {
            $language = config('app.locale'); // e.g. 'tr'
        }

        App::setLocale($language);
        Carbon::setLocale($language);

        return $next($request);
    }
}
