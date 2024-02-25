<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $with = ['messages', 'account', 'companion'];

    public function messages() {
        return $this->hasMany(Message::class, 'chat_id');
    }

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function companion() {
        return $this->belongsTo(Account::class, 'companion_id');
    }
}
