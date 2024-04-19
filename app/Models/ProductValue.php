<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $with = ['filter'];

    protected $appends = ['fullFile'];


    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id');
    }

    public function getFullFileAttribute()
    {

        $result = [];

        if ($this->filter->type == 'input_file') {
            $data = json_decode($this->value);

            if(is_array($data)) {
                foreach (json_decode($this->value) as $img) {
                    $result[] = asset('storage/' . $img);
                }
            }
            else {
                return asset('storage/' . $this->getArrayAttributeWithValue());
            }

        }

        return $result;

    }


}
