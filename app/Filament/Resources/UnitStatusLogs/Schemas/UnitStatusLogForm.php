<?php

namespace App\Filament\Resources\UnitStatusLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitStatusLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('unit_id')
                ->numeric()
                ->required(),

            TextInput::make('project_id')
                ->numeric()
                ->required(),

            TextInput::make('activity_id')
                ->numeric()
                ->nullable(),

            Select::make('status')
                ->options([
                    'ON' => 'On',
                    'BD' => 'Breakdown',
                    'STB READY' => 'Standby Ready',
                    'STS NO OP' => 'Status No Operation',
                    'NO INFO' => 'No Info',
                ])
                ->required(),

            TextInput::make('position')
                ->nullable(),

            DateTimePicker::make('start_bd'),

            Textarea::make('note')
                ->columnSpanFull(),

            TextInput::make('updated_by')
                ->numeric()
                ->required(),
        ]);
    }
}