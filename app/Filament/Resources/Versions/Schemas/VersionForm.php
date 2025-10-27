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
                Section::make(__('filament.sections.version_info.title'))
                    ->description(__('filament.sections.version_info.description'))
                    ->schema([
                        Select::make('app_id')
                            ->label(__('filament.fields.app_id'))
                            ->options(App::query()->pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->helperText(__('filament.helpers.select_app')),

                        TextInput::make('code')
                            ->label(__('filament.fields.code'))
                            ->required()
                            ->placeholder(__('filament.placeholders.version_code'))
                            ->helperText(__('filament.helpers.version_format'))
                            ->maxLength(50),
                    ]),

                Section::make(__('filament.sections.ota_bundle.title'))
                    ->description(__('filament.sections.ota_bundle.description'))
                    ->schema([
                        FileUpload::make('path')
                            ->label(__('filament.fields.path'))
                            ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed'])
                            ->directory('bundles')
                            ->disk('public')
                            ->required()
                            ->helperText(__('filament.helpers.upload_bundle')),
                    ]),

                Section::make(__('filament.sections.changelog.title'))
                    ->description(__('filament.sections.changelog.description'))
                    ->schema([
                        Repeater::make('changelog')
                            ->label(__('filament.fields.changelog'))
                            ->schema([
                                TextInput::make('note')
                                    ->label(__('filament.fields.note'))
                                    ->required()
                                    ->placeholder(__('filament.placeholders.changelog_note')),
                            ])
                            ->addActionLabel(__('filament.buttons.add_note'))
                            ->defaultItems(1)
                            ->helperText(__('filament.helpers.changelog_list')),
                    ]),
            ]);
    }
}
