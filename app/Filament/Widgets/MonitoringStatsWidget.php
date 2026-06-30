<?php

namespace App\Filament\Widgets;

use App\Services\DashboardMonitoringService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonitoringStatsWidget extends BaseWidget
{
    protected ?string $heading = 'Dashboard Monitoring Unit';

    protected ?string $pollingInterval = '5s';

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $data = DashboardMonitoringService::summary();

        return [
            Stat::make('Total Unit', $data['total'])
                ->description('Jumlah unit aktif')
                ->color('info'),

            Stat::make('ON', $data['on'])
                ->description('Unit sedang operasi')
                ->color('success'),

            Stat::make('BD', $data['bd'])
                ->description('Unit breakdown')
                ->color('danger'),

            Stat::make('STB Ready', $data['stb_ready'])
                ->description('Standby siap operasi')
                ->color('warning'),

            Stat::make('STS No OP', $data['sts_no_op'])
                ->description('Standby tanpa operator')
                ->color('gray'),

            Stat::make('NO INFO', $data['no_info'])
                ->description('Belum ada laporan')
                ->color('gray'),

            Stat::make('PA', $data['pa'] . '%')
                ->description('Physical Availability')
                ->color('info'),

            Stat::make('UA', $data['ua'] . '%')
                ->description('Utilization Availability')
                ->color('success'),
        ];
    }
}
