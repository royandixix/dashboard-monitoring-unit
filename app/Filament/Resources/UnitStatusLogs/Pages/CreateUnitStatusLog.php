<?php

namespace App\Filament\Resources\UnitStatusLogs\Pages;

use App\Filament\Resources\UnitStatusLogs\UnitStatusLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUnitStatusLog extends CreateRecord
{
    protected static string $resource = UnitStatusLogResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Status unit berhasil ditambahkan';
    }
}