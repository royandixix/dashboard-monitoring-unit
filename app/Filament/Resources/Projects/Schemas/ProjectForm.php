<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nama Proyek')
                ->placeholder('Masukkan nama proyek')
                ->required()
                ->maxLength(150),

            Textarea::make('description')
                ->label('Deskripsi')
                ->placeholder('Keterangan proyek')
                ->rows(4),

        ]);
    }
}