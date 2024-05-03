<?php

namespace App\Services;

use App\Models\EntityValue;
use App\Models\Filter;
use App\Models\ProductValue;
use Illuminate\Support\Facades\Storage;

class StoreFilterProduct {

    public static function save($product, $request) {


        foreach ($request->all() as $key => $value) {

            $marker = true; //for select


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

                        if(is_array($value)) {

                            $product->values()->where('filter_id', $filter->id)->delete();

                            foreach ($value as $item) {
                                $productValue = new ProductValue();
                                $productValue->value = $item;
                                $productValue->filter_id = $filter->id;
                                $productValue->product_id = $product->id;
                                $productValue->filter_value_id = $item;
                                $productValue->save();

                            }

                            $marker = false;
                        }

//                        $productValue->filter_value_id = $value;
                        break;
                    case('input_file'):

                        $filterValues = $product->values->where('filter_id', $filter->id);

                        foreach ($filterValues as $filterValue) {
                            Storage::disk('public')->delete($filterValue);
                        }

                        $files = $value;
                        $link = [];

                        foreach ($files as $file) {
                            $link[] = \Str::replace('public/', '', $file->store('public/filters'));
                        }

                        $value = json_encode($link);

                        break;
                }

                if($value && $marker) {
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



                if($entityModel->values->where('filter_id', $filter->id)->first()) {
                    $entityValue = $entityModel->values->where('filter_id', $filter->id)->first();
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
                        $files = $value;
                        if(is_array($files)) {
                            $result = [];
                            foreach ($files as $file) {
                                $result[] = \Str::replace('public/', '', $file->store('public/filters'));
                            }

                            $value = json_encode($result);
                        }


                        break;
                }

                $entityValue->value = $value;
                $entityValue->filter_id = $filter->id;
                $entityValue->entity_id = $entityModel->id;
                $entityValue->save();


            }

        }

    }

}
