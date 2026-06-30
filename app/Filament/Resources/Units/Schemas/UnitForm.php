<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('project_id')
                ->label('Project')
                ->relationship('project', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('equipment_category_id')
                ->label('Jenis Unit')
                ->relationship('equipmentCategory', 'name')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('unit_code')
                ->label('Nomor Lambung')
                ->placeholder('Contoh: EXCA-200-001')
                ->required()
                ->maxLength(100)
                ->unique(ignoreRecord: true),

            Select::make('current_status')
                ->label('Status Awal')
                ->options([
                    'ON' => 'ON',
                    'BD' => 'BD / Breakdown',
                    'STB READY' => 'STB READY',
                    'STS NO OP' => 'STS NO OP',
                    'NO INFO' => 'NO INFO',
                ])
                ->default('NO INFO')
                ->live()
                ->required(),

            Select::make('current_activity_id')
                ->label('Aktivitas Saat Ini')
                ->relationship('activity', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

            TextInput::make('current_position')
                ->label('Posisi Saat Ini')
                ->placeholder('Contoh: Pit A / Workshop / Karbo 2')
                ->nullable(),

            DateTimePicker::make('current_start_bd')
                ->label('Start BD')
                ->visible(fn ($get) => $get('current_status') === 'BD')
                ->required(fn ($get) => $get('current_status') === 'BD'),

            Toggle::make('is_active')
                ->label('Unit Aktif')
                ->default(true)
                ->required(),
        ]);
    }
}