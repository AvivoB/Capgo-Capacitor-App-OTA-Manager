<?php

namespace App\Filament\Resources\Versions;

use App\Filament\Resources\Versions\Pages\CreateVersion;
use App\Filament\Resources\Versions\Pages\EditVersion;
use App\Filament\Resources\Versions\Pages\ListVersions;
use App\Filament\Resources\Versions\Schemas\VersionForm;
use App\Filament\Resources\Versions\Tables\VersionsTable;
use App\Models\Version;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VersionResource extends Resource
{
    protected static ?string $model = Version::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'code';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.version.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.version.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.version.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.resources.version.navigation_group');
    }

    public static function form(Schema $schema): Schema
    {
        return VersionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VersionsTable::configure($table);
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
            'index' => ListVersions::route('/'),
            'create' => CreateVersion::route('/create'),
            'edit' => EditVersion::route('/{record}/edit'),
        ];
    }
}
