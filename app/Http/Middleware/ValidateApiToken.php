<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupère le token depuis le header Authorization ou le paramètre api_token
        $token = $request->bearerToken() ?? $request->input('api_token') ?? $request->header('X-API-Token');

        if (!$token) {
            return response()->json([
                'error' => 'API token is required',
                'message' => 'Please provide a valid API token in the Authorization header (Bearer token), X-API-Token header, or as api_token parameter',
            ], 401);
        }

        if (!ApiToken::isValid($token)) {
            return response()->json([
                'error' => 'Invalid or expired API token',
                'message' => 'The provided API token is invalid or has been revoked',
            ], 401);
        }

        return $next($request);
    }
}
