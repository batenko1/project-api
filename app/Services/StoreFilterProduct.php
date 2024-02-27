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
                        $productValue->value = $value;
                        $productValue->filter_id = $filter->id;
                        $productValue->product_id = $product->id;
                        $productValue->save();
                        break;
                }

            }

        }

    }

}
