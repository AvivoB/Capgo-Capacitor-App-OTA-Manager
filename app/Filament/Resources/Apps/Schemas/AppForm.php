<?php

namespace App\Filament\Resources\Apps\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class AppForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom de l\'application')
                    ->required()
                    ->maxLength(255)
                    ->reactive() // ← très important
                    ->afterStateUpdated(function ($state, $set) {
                        // Met à jour automatiquement l'identifiant
                        $set('identifier', Str::slug($state));
                    }),

                TextInput::make('identifier')
                    ->label('Code identifiant l\'application')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('appicon')
                    ->label('Icône de l’application')
                    ->avatar(),
            ]);
    }
}
