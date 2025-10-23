<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    /** @use HasFactory<\Database\Factories\AppFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'identifier',
        'appicon',
    ];

    /**
     * Relation avec les versions de l'application
     */
    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    /**
     * Récupère la dernière version de l'application
     */
    public function latestVersion()
    {
        return $this->versions()->latest('created_at')->first();
    }
}
