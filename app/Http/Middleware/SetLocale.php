<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        // Check if locale is in query parameter
        elseif ($request->has('locale')) {
            $locale = $request->get('locale');
            Session::put('locale', $locale);
        }
        // Check browser language preference
        elseif ($request->hasHeader('Accept-Language')) {
            $preferredLanguage = $request->getPreferredLanguage(['en', 'fr']);
            $locale = $preferredLanguage ?: config('app.locale');
        }
        // Use default locale from config
        else {
            $locale = config('app.locale');
        }

        // Validate locale
        if (!in_array($locale, ['en', 'fr'])) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
