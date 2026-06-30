<?php

namespace App\Filament\Resources\UnitStatusLogs\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitStatusLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit.unit_code')
                    ->label('Nomor Lambung')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unit.equipmentCategory.name')
                    ->label('Jenis Unit')
                    ->searchable(),

                TextColumn::make('activity.name')
                    ->label('Aktivitas')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ON' => 'success',
                        'BD' => 'danger',
                        'STB READY' => 'warning',
                        'STS NO OP' => 'gray',
                        'NO INFO' => 'secondary',
                        default => 'secondary',
                    }),

                TextColumn::make('position')
                    ->label('Posisi')
                    ->searchable(),

                TextColumn::make('start_bd')
                    ->label('Start BD')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('PIC')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Waktu Update')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}