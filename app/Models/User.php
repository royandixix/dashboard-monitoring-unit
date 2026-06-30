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
        'role',
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

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [
            'super_admin',
            'admin',
            'viewer',
        ], true);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    public function canManageMasterData(): bool
    {
        return in_array($this->role, [
            'super_admin',
            'admin',
        ], true);
    }

    public function canUpdateUnitStatus(): bool
    {
        return in_array($this->role, [
            'super_admin',
            'admin',
        ], true);
    }

    public function canViewDashboard(): bool
    {
        return in_array($this->role, [
            'super_admin',
            'admin',
            'viewer',
        ], true);
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