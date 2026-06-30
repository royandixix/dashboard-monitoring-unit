<?php

namespace App\Filament\Resources\UpdateUnitStatuses\Schemas;

use App\Models\Location;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
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

            Select::make('current_position')
                ->label('Posisi')
                ->options(
                    Location::query()
                        ->orderBy('name')
                        ->pluck('name', 'name')
                        ->toArray()
                )
                ->searchable()
                ->preload()
                ->nullable(),

            DateTimePicker::make('current_start_bd')
                ->label('Start BD')
                ->visible(fn ($get): bool => $get('current_status') === 'BD')
                ->required(fn ($get): bool => $get('current_status') === 'BD'),
        ]);
    }
}
