<?php

namespace App\Filament\Resources\Versions\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Illuminate\Support\HtmlString;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\RichEditor\RichContentRenderer;

class VersionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('app.name')
                    ->label('Application')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Code de version')
                    ->searchable(),
                TextColumn::make('path')
                    ->label('Chemin du Bundle')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
