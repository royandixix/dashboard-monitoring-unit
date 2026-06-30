<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'project_id',
        'equipment_category_id',
        'unit_code',
        'current_status',
        'current_activity_id',
        'current_position',
        'current_start_bd',
        'last_updated_by',
        'last_updated_at',
        'is_active',
    ];

    protected $casts = [
        'current_start_bd' => 'datetime',
        'last_updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'current_activity_id');
    }

    public function statusLogs()
    {
        return $this->hasMany(UnitStatusLog::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }
}