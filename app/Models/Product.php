<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'entity_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'entity',
        'values'
    ];

    public function entity() {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function values() {
        return $this->belongsToMany(FilterValue::class, 'product_value', 'product_id', 'filter_value_id');
    }
}
