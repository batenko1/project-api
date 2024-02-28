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
                $productValue = new ProductValue();

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
                    case('file'):
                        $file = $value;
                        $value = $file->store('filters');
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
