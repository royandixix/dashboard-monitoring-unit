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
            'operation',
            'manager_viewer',

            // role lama tetap diizinkan supaya tidak langsung error
            'admin',
            'viewer',
        ], true);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isOperation(): bool
    {
        return in_array($this->role, [
            'operation',
            'admin',
        ], true);
    }

    public function isManagerViewer(): bool
    {
        return in_array($this->role, [
            'manager_viewer',
            'viewer',
        ], true);
    }

    public function canManageMasterData(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canUpdateUnitStatus(): bool
    {
        return $this->isSuperAdmin() || $this->isOperation();
    }

    public function canInputHauler(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canViewDashboard(): bool
    {
        return $this->isSuperAdmin()
            || $this->isOperation()
            || $this->isManagerViewer();
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
