<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Account extends Authenticatable
{
    use HasFactory, HasRoles;

    public function orders() {
        return $this->hasMany(Order::class, 'account_id');
    }
}
