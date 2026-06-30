<?php

namespace App\Filament\Resources\UpdateUnitStatuses\Pages;

use App\Filament\Resources\UpdateUnitStatuses\UpdateUnitStatusResource;
use Filament\Resources\Pages\ListRecords;

class ListUpdateUnitStatuses extends ListRecords
{
    protected static string $resource = UpdateUnitStatusResource::class;

    protected static ?string $title = 'Update Unit A2B';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
