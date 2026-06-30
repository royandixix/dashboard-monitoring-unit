<?php

namespace App\Filament\Widgets;

use App\Models\Unit;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestUnitUpdatesWidget extends BaseWidget
{
    protected static ?string $heading = 'Monitoring Unit Terbaru';

    protected ?string $pollingInterval = '5s';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Unit::query()
                    ->with([
                        'project',
                        'equipmentCategory',
                        'activity',
                        'updatedBy',
                    ])
                    ->where('is_active', true)
            )
            ->columns([
                TextColumn::make('unit_code')
                    ->label('No Unit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('unit_group')
                    ->label('Kelompok')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'A2B' => 'info',
                        'HAULER' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('equipmentCategory.name')
                    ->label('Jenis Unit')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('current_position')
                    ->label('Posisi')
                    ->placeholder('Belum diisi')
                    ->searchable(),

                TextColumn::make('activity.name')
                    ->label('Aktivitas')
                    ->placeholder('Belum diisi')
                    ->searchable(),

                TextColumn::make('current_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ON' => 'success',
                        'BD' => 'danger',
                        'STB READY' => 'warning',
                        'STS NO OP' => 'gray',
                        'NO INFO' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

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
            ])
            ->defaultSort('last_updated_at', 'desc')
            ->paginated([10, 25, 50, 100]);
    }
}
