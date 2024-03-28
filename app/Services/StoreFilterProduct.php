<?php

namespace App\Services;

use App\Models\EntityValue;
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

    public static function saveEntity($entityModel, $request) {


        foreach ($request->all() as $key => $value) {

            if(str_contains($key, 'entity_filter')) {

                list($word, $entity, $filterId) = explode('_', $key);
                $filter = Filter::query()->find($filterId);

                if(!$filter) {
                    continue;
                }

                if($entityModel->values->where('filter_id', $filter->id)->where('is_entity', 1)->first()) {
                    $entityValue = $entityModel->values->where('filter_id', $filter->id)->where('is_entity', 1)->first();
                }
                else {
                    $entityValue = new EntityValue();
                }



                switch ($filter->type) {
                    case('input_text'):
                    case('input_date'):
                    case('textarea'):
                    case('checkbox'):
                        $entityValue->value = $value;
                        break;
                    case('select'):
                        $entityValue->filter_value_id = $value;
                        break;
                    case('input_file'):
                        $file = $value;
                        $value = \Str::replace('public/', '', $file->store('public/filters'));

                        break;
                }

                if($value) {
                    $entityValue->value = $value;
                    $entityValue->filter_id = $filter->id;
                    $entityValue->entity_id = $entityModel->id;
                    $entityValue->save();
                }


            }

        }

    }

}
