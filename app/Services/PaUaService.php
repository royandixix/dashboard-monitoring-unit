<?php

namespace App\Services;

use App\Models\Unit;

class PaUaService
{
    public static function calculate($projectId = null): array
    {
        $query = Unit::query()
            ->where('is_active', true);

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $units = $query->get();

        $total = $units->count();

        $on = $units->where('current_status', 'ON')->count();

        $bd = $units->where('current_status', 'BD')->count();

        $stbReady = $units->where('current_status', 'STB READY')->count();

        $stsNoOp = $units->where('current_status', 'STS NO OP')->count();

        $noInfo = $units->where('current_status', 'NO INFO')->count();

        $available = $on + $stbReady + $stsNoOp;

        $pa = $total > 0 ? ($available / $total) * 100 : 0;

        $ua = $available > 0 ? ($on / $available) * 100 : 0;

        return [
            'total' => $total,
            'on' => $on,
            'bd' => $bd,
            'stb_ready' => $stbReady,
            'sts_no_op' => $stsNoOp,
            'no_info' => $noInfo,
            'available' => $available,
            'pa' => round($pa, 2),
            'ua' => round($ua, 2),
        ];
    }
}