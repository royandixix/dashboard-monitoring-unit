<?php

namespace App\Filament\Resources\UpdateUnitStatuses\Pages;

use App\Filament\Resources\UpdateUnitStatuses\UpdateUnitStatusResource;
use App\Models\UnitStatusLog;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUpdateUnitStatus extends EditRecord
{
    protected static string $resource = UpdateUnitStatusResource::class;

    protected static ?string $title = 'Update Status Unit';

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['current_status'] ?? null) !== 'BD') {
            $data['current_start_bd'] = null;
        }

        $data['last_updated_by'] = auth()->id();
        $data['last_updated_at'] = now();

        return $data;
    }

    protected function afterSave(): void
    {
        UnitStatusLog::create([
            'unit_id' => $this->record->id,
            'project_id' => $this->record->project_id,
            'activity_id' => $this->record->current_activity_id,
            'status' => $this->record->current_status,
            'position' => $this->record->current_position,
            'start_bd' => $this->record->current_start_bd,
            'updated_by' => auth()->id(),
        ]);

        Notification::make()
            ->title('Status unit berhasil diperbarui')
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}