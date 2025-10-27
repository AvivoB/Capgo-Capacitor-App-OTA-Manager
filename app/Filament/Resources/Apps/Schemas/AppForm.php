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
                    ->label(__('filament.fields.name'))
                    ->required()
                    ->maxLength(255)
                    ->reactive() // ← très important
                    ->afterStateUpdated(function ($state, $set) {
                        // Met à jour automatiquement l'identifiant
                        $set('identifier', Str::slug($state));
                    }),

                TextInput::make('identifier')
                    ->label(__('filament.fields.identifier'))
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
