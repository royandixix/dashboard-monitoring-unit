<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table

        ->columns([

            TextColumn::make('name')
                ->label('Nama Proyek')
                ->searchable()
                ->sortable(),

            TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(50),

            TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y')
                ->sortable(),

        ])

        ->actions([
            EditAction::make()
                ->label('Edit'),
        ])

        ->bulkActions([

            BulkActionGroup::make([

                DeleteBulkAction::make()
                    ->label('Hapus'),

            ]),

        ]);

    }
}