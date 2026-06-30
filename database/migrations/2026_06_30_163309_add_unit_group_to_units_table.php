<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('units', 'unit_group')) {
            Schema::table('units', function (Blueprint $table) {
                $table->string('unit_group')
                    ->default('A2B')
                    ->after('equipment_category_id');
            });
        }

        DB::table('units')
            ->whereIn('equipment_category_id', function ($query) {
                $query->select('id')
                    ->from('equipment_categories')
                    ->where('name', 'like', '%Dump%')
                    ->orWhere('name', 'like', '%Truck%')
                    ->orWhere('name', 'like', '%Hauler%')
                    ->orWhere('name', 'like', '%DT%');
            })
            ->update(['unit_group' => 'HAULER']);
    }

    public function down(): void
    {
        if (Schema::hasColumn('units', 'unit_group')) {
            Schema::table('units', function (Blueprint $table) {
                $table->dropColumn('unit_group');
            });
        }
    }
};
