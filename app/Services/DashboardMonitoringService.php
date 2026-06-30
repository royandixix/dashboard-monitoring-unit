<?php

namespace App\Services;

use App\Models\Unit;

class DashboardMonitoringService
{
    public const STATUSES = [
        'ON',
        'BD',
        'STB READY',
        'STS NO OP',
        'NO INFO',
    ];

    public static function summary(?int $projectId = null): array
    {
        $query = Unit::query()
            ->where('is_active', true);

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $total = (clone $query)->count();

        $counts = (clone $query)
            ->selectRaw('current_status, COUNT(*) as total')
            ->groupBy('current_status')
            ->pluck('total', 'current_status');

        $on = (int) ($counts['ON'] ?? 0);
        $bd = (int) ($counts['BD'] ?? 0);
        $stbReady = (int) ($counts['STB READY'] ?? 0);
        $stsNoOp = (int) ($counts['STS NO OP'] ?? 0);
        $noInfo = (int) ($counts['NO INFO'] ?? 0);

        $available = $on + $stbReady + $stsNoOp;

        $pa = $total > 0 ? round(($available / $total) * 100, 2) : 0;
        $ua = $available > 0 ? round(($on / $available) * 100, 2) : 0;

        return [
            'total' => $total,
            'on' => $on,
            'bd' => $bd,
            'stb_ready' => $stbReady,
            'sts_no_op' => $stsNoOp,
            'no_info' => $noInfo,
            'available' => $available,
            'pa' => $pa,
            'ua' => $ua,
        ];
    }

    public static function statusByCategory(): array
    {
        $rows = Unit::query()
            ->join('equipment_categories', 'equipment_categories.id', '=', 'units.equipment_category_id')
            ->where('units.is_active', true)
            ->selectRaw('equipment_categories.name as category, units.current_status as status, COUNT(*) as total')
            ->groupBy('equipment_categories.name', 'units.current_status')
            ->orderBy('equipment_categories.name')
            ->get();

        $labels = $rows
            ->pluck('category')
            ->unique()
            ->values()
            ->all();

        $datasets = [];

        foreach (self::STATUSES as $status) {
            $datasets[$status] = collect($labels)
                ->map(function ($label) use ($rows, $status) {
                    $match = $rows->first(
                        fn ($row) => $row->category === $label && $row->status === $status
                    );

                    return (int) ($match?->total ?? 0);
                })
                ->all();
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
}
