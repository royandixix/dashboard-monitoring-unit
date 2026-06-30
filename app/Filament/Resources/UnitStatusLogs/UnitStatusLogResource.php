<?php

namespace App\Filament\Resources\UnitStatusLogs;

use App\Filament\Resources\UnitStatusLogs\Pages;
use App\Filament\Resources\UnitStatusLogs\Tables\UnitStatusLogsTable;
use App\Models\UnitStatusLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UnitStatusLogResource extends Resource
{
    protected static ?string $model = UnitStatusLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Riwayat Status';

    protected static ?string $modelLabel = 'Riwayat Status';

    protected static ?string $pluralModelLabel = 'Riwayat Status';

    protected static string|\UnitEnum|null $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 2;


    public static function canAccess(): bool
    {
        return auth()->user()?->canViewDashboard() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return UnitStatusLogsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitStatusLogs::route('/'),
        ];
    }
}