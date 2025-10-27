<?php

namespace App\Filament\Resources\Apps;

use App\Filament\Resources\Apps\Pages\CreateApp;
use App\Filament\Resources\Apps\Pages\EditApp;
use App\Filament\Resources\Apps\Pages\ListApps;
use App\Filament\Resources\Apps\Schemas\AppForm;
use App\Filament\Resources\Apps\Tables\AppsTable;
use App\Models\App;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AppResource extends Resource
{
    protected static ?string $model = App::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.app.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.app.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.app.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.resources.app.navigation_group');
    }

    public static function form(Schema $schema): Schema
    {
        return AppForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AppsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApps::route('/'),
            'create' => CreateApp::route('/create'),
            'edit' => EditApp::route('/{record}/edit'),
        ];
    }

    
}
