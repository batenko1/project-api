<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $with = ['filter'];


    public function filter() {
        return $this->belongsTo(Filter::class, 'filter_id');
    }

}
