<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nama Lokasi')
                ->placeholder('Contoh: Pit A, Workshop, Stockpile')
                ->required()
                ->maxLength(100),

        ]);
    }
}