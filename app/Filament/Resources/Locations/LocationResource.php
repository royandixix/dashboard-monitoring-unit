<?php

namespace App\Filament\Resources\Locations;

use App\Models\Location;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Locations\Pages;
use App\Filament\Resources\Locations\Schemas\LocationForm;
use App\Filament\Resources\Locations\Tables\LocationsTable;

class LocationResource extends Resource
{
    protected static ?string $model=Location::class;

    protected static string|BackedEnum|null $navigationIcon=Heroicon::OutlinedMapPin;

    protected static ?string $navigationLabel='Lokasi Unit';

    protected static ?string $modelLabel='Lokasi';

    protected static ?string $pluralModelLabel='Lokasi Unit';

    protected static string|\UnitEnum|null $navigationGroup='Master Data';



    public static function canAccess(): bool
    {
        return auth()->user()?->canManageMasterData() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return LocationForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return LocationsTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index'=>Pages\ListLocations::route('/'),
            'create'=>Pages\CreateLocation::route('/create'),
            'edit'=>Pages\EditLocation::route('/{record}/edit'),
        ];
    }

    // main data masuk 
}