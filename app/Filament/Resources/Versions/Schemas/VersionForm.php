<?php

namespace App\Filament\Resources\Versions\Schemas;

use App\Models\App;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;

class VersionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la version')
                    ->description('Configurez les détails de la version OTA')
                    ->schema([
                        Select::make('app_id')
                            ->label('Application')
                            ->options(App::query()->pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->helperText('Sélectionnez l\'application pour laquelle cette version est destinée'),

                        TextInput::make('code')
                            ->label('Code de version')
                            ->required()
                            ->placeholder('1.0.0')
                            ->helperText('Format recommandé: X.Y.Z (ex: 1.2.0)')
                            ->maxLength(50),
                    ]),

                Section::make('Bundle OTA')
                    ->description('Upload le fichier ZIP contenant la mise à jour')
                    ->schema([
                        FileUpload::make('path')
                            ->label('Bundle ZIP')
                            ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed'])
                            ->directory('bundles')
                            ->disk('public')
                            ->required()
                            ->helperText('Uploadez le fichier ZIP contenant les fichiers de l\'application (dossier www/)'),
                    ]),

                Section::make('Changelog')
                    ->description('Ajoutez les notes de version')
                    ->schema([
                        Repeater::make('changelog')
                            ->label('Changelog')
                            ->schema([
                                TextInput::make('note')
                                    ->label('Note')
                                    ->required()
                                    ->placeholder('Ex: Correction du bug de connexion'),
                            ])
                            ->addActionLabel('Ajouter une note')
                            ->defaultItems(1)
                            ->helperText('Listez les modifications apportées dans cette version'),
                    ]),
            ]);
    }
}
