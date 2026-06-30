<?php

namespace App\Filament\Resources\UpdateUnitStatuses;

use App\Filament\Resources\UpdateUnitStatuses\Pages;
use App\Filament\Resources\UpdateUnitStatuses\Schemas\UpdateUnitStatusForm;
use App\Filament\Resources\UpdateUnitStatuses\Tables\UpdateUnitStatusesTable;
use App\Models\Unit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UpdateUnitStatusResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsUpDown;

    protected static ?string $navigationLabel = 'Update Status Unit';

    protected static ?string $modelLabel = 'Update Status Unit';

    protected static ?string $pluralModelLabel = 'Update Status Unit';

    protected static string|\UnitEnum|null $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'unit_code';

    public static function form(Schema $schema): Schema
    {
        return UpdateUnitStatusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UpdateUnitStatusesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUpdateUnitStatuses::route('/'),
            'edit' => Pages\EditUpdateUnitStatus::route('/{record}/edit'),
        ];
    }
}