<?php

namespace App\Filament\Resources\EquipmentCategories;

use App\Models\EquipmentCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\EquipmentCategories\Pages;
use App\Filament\Resources\EquipmentCategories\Schemas\EquipmentCategoryForm;
use App\Filament\Resources\EquipmentCategories\Tables\EquipmentCategoriesTable;

class EquipmentCategoryResource extends Resource
{
    protected static ?string $model=EquipmentCategory::class;

    protected static string|BackedEnum|null $navigationIcon=Heroicon::OutlinedTruck;

    protected static ?string $navigationLabel='Jenis Unit';

    protected static ?string $modelLabel='Jenis Unit';

    protected static ?string $pluralModelLabel='Jenis Unit';

    protected static string|\UnitEnum|null $navigationGroup='Master Data';


    public static function form(Schema $schema): Schema
    {
        return EquipmentCategoryForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return EquipmentCategoriesTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index'=>Pages\ListEquipmentCategories::route('/'),
            'create'=>Pages\CreateEquipmentCategory::route('/create'),
            'edit'=>Pages\EditEquipmentCategory::route('/{record}/edit'),
        ];
    }
}