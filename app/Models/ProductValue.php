<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $with = ['filter'];

    protected $appends = ['fullFile'];


    public function filter() {
        return $this->belongsTo(Filter::class, 'filter_id');
    }

    public function getFullFileAttribute() {

        if($this->filter->type == 'input_file') {
            return asset('storage/' . $this->value);
        }

    }


}
