<?php

namespace App\Filament\Resources\UpdateUnitStatuses\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UpdateUnitStatusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit_code')
                    ->label('Nomor Lambung')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('equipmentCategory.name')
                    ->label('Jenis Unit')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('current_status')
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

                TextColumn::make('activity.name')
                    ->label('Aktivitas')
                    ->searchable(),

                TextColumn::make('current_position')
                    ->label('Posisi')
                    ->searchable(),

                TextColumn::make('current_start_bd')
                    ->label('Start BD')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('updatedBy.name')
                    ->label('PIC')
                    ->searchable(),

                TextColumn::make('last_updated_at')
                    ->label('Waktu Update')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('last_updated_at', 'desc')
            ->recordActions([
                EditAction::make()
                    ->label('Update Status')
                    ->icon('heroicon-o-pencil-square'),
            ]);
    }
}