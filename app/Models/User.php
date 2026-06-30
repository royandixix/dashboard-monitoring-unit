<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function updatedUnits()
    {
        return $this->hasMany(
            Unit::class,
            'last_updated_by'
        );
    }

    public function statusLogs()
    {
        return $this->hasMany(
            UnitStatusLog::class,
            'updated_by'
        );
    }
}