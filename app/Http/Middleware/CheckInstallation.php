<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Vérifie si l'application est installée, sinon redirige vers l'onboarding
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Routes qui ne nécessitent pas l'installation
        $excludedRoutes = [
            'onboarding',
            'onboarding.store',
        ];

        // Si on est sur une route exclue, on continue
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        // Si l'application n'est pas installée, rediriger vers l'onboarding
        if (!Setting::isInstalled()) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
