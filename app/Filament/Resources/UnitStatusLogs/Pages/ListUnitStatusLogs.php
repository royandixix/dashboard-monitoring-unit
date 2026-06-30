<?php

namespace App\Filament\Resources\UnitStatusLogs\Pages;

use App\Filament\Resources\UnitStatusLogs\UnitStatusLogResource;
use Filament\Resources\Pages\ListRecords;

class ListUnitStatusLogs extends ListRecords
{
    protected static string $resource = UnitStatusLogResource::class;

    protected static ?string $title = 'Riwayat Status Unit';

    protected function getHeaderActions(): array
    {
        return [];
    }
}