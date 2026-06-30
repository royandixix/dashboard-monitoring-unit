<?php

namespace App\Filament\Resources\UpdateUnitStatuses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UpdateUnitStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('current_status')
                ->label('Status')
                ->options([
                    'ON' => 'ON',
                    'BD' => 'BD / Breakdown',
                    'STB READY' => 'STB READY',
                    'STS NO OP' => 'STS NO OP',
                    'NO INFO' => 'NO INFO',
                ])
                ->live()
                ->required(),

            Select::make('current_activity_id')
                ->label('Aktivitas')
                ->relationship('activity', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

            TextInput::make('current_position')
                ->label('Posisi')
                ->placeholder('Contoh: Pit A / Workshop / Karbo 2')
                ->nullable(),

            DateTimePicker::make('current_start_bd')
                ->label('Start BD')
                ->visible(fn ($get) => $get('current_status') === 'BD')
                ->required(fn ($get) => $get('current_status') === 'BD'),
        ]);
    }
}