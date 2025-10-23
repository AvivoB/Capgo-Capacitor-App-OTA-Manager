<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    /** @use HasFactory<\Database\Factories\VersionFactory> */
    use HasFactory;

    protected $fillable = [
        'app_id',
        'code',
        'changelog',
        'path',
    ];

    protected function casts(): array
    {
        return [
            'changelog' => 'array',
        ];
    }

    /**
     * Relation avec l'application parente
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Récupère l'URL complète du bundle
     */
    public function getBundleUrlAttribute(): string
    {
        return url('storage/' . $this->path);
    }
}
