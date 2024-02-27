<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'account_id');
    }

    public function photos() {
        return $this->hasMany(AccountPhoto::class, 'account_id');
    }
}
