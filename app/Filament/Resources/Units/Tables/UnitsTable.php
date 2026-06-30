<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unit_group')
                    ->label('Kelompok')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'A2B' => 'info',
                        'HAULER' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('equipmentCategory.name')
                    ->label('Jenis Unit')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unit_code')
                    ->label('Nomor Lambung')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

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
                    ->placeholder('Belum diisi')
                    ->searchable(),

                TextColumn::make('current_position')
                    ->label('Posisi')
                    ->placeholder('Belum diisi')
                    ->searchable(),

                TextColumn::make('current_start_bd')
                    ->label('Start BD')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('updatedBy.name')
                    ->label('PIC')
                    ->placeholder('Belum ada PIC')
                    ->searchable(),

                TextColumn::make('last_updated_at')
                    ->label('Update Terakhir')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Belum pernah update')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->recordActions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }
}
