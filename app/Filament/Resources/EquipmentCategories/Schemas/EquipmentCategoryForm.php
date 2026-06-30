<?php

namespace App\Filament\Resources\EquipmentCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class EquipmentCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nama Jenis Unit')
                ->placeholder('Contoh: Excavator 200')
                ->required()
                ->maxLength(100),

        ]);
    }
}