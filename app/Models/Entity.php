<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $with = ['child', 'filters'];


    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'entity_id');
    }

    public function filters() {
        return $this->hasMany(Filter::class, 'entity_id');
    }
}
