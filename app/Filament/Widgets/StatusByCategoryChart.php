<?php

namespace App\Filament\Widgets;

use App\Services\DashboardMonitoringService;
use Filament\Widgets\ChartWidget;

class StatusByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Status Unit per Jenis Unit';

    protected ?string $pollingInterval = '5s';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = DashboardMonitoringService::statusByCategory();

        return [
            'labels' => $data['labels'],
            'datasets' => [
                [
                    'label' => 'ON',
                    'data' => $data['datasets']['ON'],
                ],
                [
                    'label' => 'BD',
                    'data' => $data['datasets']['BD'],
                ],
                [
                    'label' => 'STB READY',
                    'data' => $data['datasets']['STB READY'],
                ],
                [
                    'label' => 'STS NO OP',
                    'data' => $data['datasets']['STS NO OP'],
                ],
                [
                    'label' => 'NO INFO',
                    'data' => $data['datasets']['NO INFO'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
