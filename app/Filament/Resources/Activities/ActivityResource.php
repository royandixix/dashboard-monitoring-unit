<?php

namespace App\Filament\Resources\Activities;

use App\Models\Activity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Activities\Pages;
use App\Filament\Resources\Activities\Schemas\ActivityForm;
use App\Filament\Resources\Activities\Tables\ActivitiesTable;

class ActivityResource extends Resource
{
    protected static ?string $model=Activity::class;

    protected static string|BackedEnum|null $navigationIcon=Heroicon::OutlinedBolt;

    protected static ?string $navigationLabel='Aktivitas Unit';

    protected static ?string $modelLabel='Aktivitas';

    protected static ?string $pluralModelLabel='Aktivitas Unit';

    protected static string|\UnitEnum|null $navigationGroup='Master Data';


    public static function form(Schema $schema): Schema
    {
        return ActivityForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return ActivitiesTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index'=>Pages\ListActivities::route('/'),
            'create'=>Pages\CreateActivity::route('/create'),
            'edit'=>Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}