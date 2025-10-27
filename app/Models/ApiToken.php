<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    protected $fillable = [
        'name',
        'token',
        'is_active',
        'last_used_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    /**
     * Génère un nouveau token API
     *
     * @return string
     */
    public static function generateToken(): string
    {
        return hash('sha256', Str::random(60));
    }

    /**
     * Crée un nouveau token API
     *
     * @param string $name
     * @return self
     */
    public static function createToken(string $name = 'Default API Token'): self
    {
        return self::create([
            'name' => $name,
            'token' => self::generateToken(),
            'is_active' => true,
        ]);
    }

    /**
     * Vérifie si un token est valide
     *
     * @param string $token
     * @return bool
     */
    public static function isValid(string $token): bool
    {
        $apiToken = self::where('token', $token)
            ->where('is_active', true)
            ->first();

        if ($apiToken) {
            // Met à jour la dernière utilisation
            $apiToken->update(['last_used_at' => now()]);
            return true;
        }

        return false;
    }

    /**
     * Récupère le token actif
     *
     * @return self|null
     */
    public static function getActiveToken(): ?self
    {
        return self::where('is_active', true)->first();
    }
}
