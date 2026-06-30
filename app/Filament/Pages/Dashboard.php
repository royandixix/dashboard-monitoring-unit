<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestUnitUpdatesWidget;
use App\Filament\Widgets\MonitoringStatsWidget;
use App\Filament\Widgets\StatusByCategoryChart;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Dashboard Monitoring Unit';

    protected static ?int $navigationSort = 1;

    public function getTitle(): string
    {
        return 'Dashboard Monitoring Unit';
    }

    public function getWidgets(): array
    {
        return [
            LatestUnitUpdatesWidget::class,
            MonitoringStatsWidget::class,
            StatusByCategoryChart::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 12;
    }
}
