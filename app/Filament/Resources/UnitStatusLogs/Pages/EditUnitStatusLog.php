<?php

namespace App\Filament\Resources\UnitStatusLogs\Pages;

use App\Filament\Resources\UnitStatusLogs\UnitStatusLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUnitStatusLog extends EditRecord
{
    protected static string $resource = UnitStatusLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Status')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Status unit berhasil diperbarui';
    }

    protected function getDeletedNotificationTitle(): ?string
    {
        return 'Status unit berhasil dihapus';
    }
}