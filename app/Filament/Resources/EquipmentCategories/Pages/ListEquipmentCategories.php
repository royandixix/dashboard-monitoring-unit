<?php

namespace App\Filament\Resources\EquipmentCategories\Pages;

use App\Filament\Resources\EquipmentCategories\EquipmentCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEquipmentCategories extends ListRecords
{
    protected static string $resource=EquipmentCategoryResource::class;

    protected static ?string $title='Master Jenis Unit';


    protected function getHeaderActions(): array
    {
        return [

            CreateAction::make()
                ->label('Tambah Jenis Unit'),

        ];
    }
}