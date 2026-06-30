<?php

namespace App\Filament\Resources\EquipmentCategories\Pages;

use App\Filament\Resources\EquipmentCategories\EquipmentCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEquipmentCategory extends EditRecord
{
    protected static string $resource=EquipmentCategoryResource::class;

    protected static ?string $title='Edit Jenis Unit';


    protected function getHeaderActions(): array
    {
        return [

            DeleteAction::make()
                ->label('Hapus Jenis Unit'),

        ];
    }

    
}