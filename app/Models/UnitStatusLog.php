<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitStatusLog extends Model
{
    protected $fillable = [
        'unit_id',
        'project_id',
        'activity_id',
        'status',
        'position',
        'start_bd',
        'note',
        'updated_by',
    ];

    protected $casts = [
        'start_bd' => 'datetime',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}