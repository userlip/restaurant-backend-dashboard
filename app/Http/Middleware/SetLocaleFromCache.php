<?php

namespace App\Http\Middleware;

use App\Enums\SupportedLocaleEnums;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session()->get('_token');
        
        if ($token) {
            $locale = Cache::get($token);
            
            if ($locale && in_array($locale, SupportedLocaleEnums::getOptions())) {
                App::setLocale($locale);
            }
        }
        
        return $next($request);
    }
}