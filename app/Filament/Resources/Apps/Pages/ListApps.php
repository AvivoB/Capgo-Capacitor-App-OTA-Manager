<?php

namespace App\Filament\Resources\Apps\Pages;

use App\Filament\Resources\Apps\AppResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApps extends ListRecords
{
    protected static string $resource = AppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
