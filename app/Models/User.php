<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory, Notifiable;

    const ROLE_OWNER = 'owner';
    const ROLE_MANAGER = 'manager';
    const ROLE_CASHIER = 'cashier';

    const ROLES = [
        self::ROLE_OWNER => 'Owner',
        self::ROLE_MANAGER => 'Manager',
        self::ROLE_CASHIER => 'Cashier',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isOwner() || $this->isManager() || $this->isCashier();
    }

    public function isOwner()
    {
        return $this->role === self::ROLE_OWNER;
    }

    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function isCashier()
    {
        return $this->role === self::ROLE_CASHIER;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Parent of Orders Relations
     */
    public function orders()
    {
        return $this->hasMany(Order::class,);
    }
}
