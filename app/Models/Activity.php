<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
    ];


    public function units()
    {
        return $this->hasMany(
            Unit::class,
            'current_activity_id'
        );
    }


    public function statusLogs()
    {
        return $this->hasMany(
            UnitStatusLog::class
        );
    }
}