<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Récupère une valeur de configuration
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Définit une valeur de configuration
     */
    public static function set(string $key, $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Vérifie si l'application est installée
     */
    public static function isInstalled(): bool
    {
        return self::get('is_installed', '0') === '1';
    }

    /**
     * Marque l'application comme installée
     */
    public static function markAsInstalled(): void
    {
        self::set('is_installed', '1');
    }
}
