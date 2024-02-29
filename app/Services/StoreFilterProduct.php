<?php

namespace App\Services;

use App\Models\Filter;
use App\Models\ProductValue;

class StoreFilterProduct {

    public static function save($product, $request) {


        foreach ($request->all() as $key => $value) {

            if(str_contains($key, 'filter')) {

                list($word, $filterId) = explode('_', $key);
                $filter = Filter::query()->findOrFail($filterId);

                if($product->values->where('filter_id', $filter->id)->first()) {
                    $productValue = $product->values->where('filter_id', $filter->id)->first();
                }
                else {
                    $productValue = new ProductValue();
                }


                switch ($filter->type) {
                    case('input_text'):
                    case('input_date'):
                    case('textarea'):
                    case('checkbox'):
                        $productValue->value = $value;
                        break;
                    case('select'):
                        $productValue->filter_value_id = $value;
                        break;
                    case('input_file'):
                        $file = $value;
                        $value = \Str::replace('public/', '', $file->store('public/filters'));

                        break;
                }

                if($value) {
                    $productValue->value = $value;
                    $productValue->filter_id = $filter->id;
                    $productValue->product_id = $product->id;
                    $productValue->save();
                }


            }

        }

    }

}
