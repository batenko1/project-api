<?php

namespace App\Services;

use App\Models\Filter;
use App\Models\FilterValue;

class StoreFilters
{

    public static function save($entity, $request)
    {

        $filters = $request->filter_type;


//        dd($request->all());

        foreach ($filters as $key => $filter) {

            if(!$filter) {
                continue;
            }


            $title = $request->filter_name[$key];


            $newFilter = Filter::query()->where('id', $key)->first();

            if(!$newFilter) {
                $newFilter = new Filter();
            }

            $newFilter->entity_id = $entity->id;
            $newFilter->title = $title;
            $newFilter->type = $filter;
            $newFilter->is_required = $filter->is_required ?? 0;
            $newFilter->is_default = $filter->is_default ?? 0;

            $newFilter->save();

            if($filter == 'select') {
                $values = $request->filter_values[$key];
                $values = explode(',', $values);

                foreach ($values as $value) {
                    $newFilterValue = new FilterValue();
                    $newFilterValue->filter_id = $newFilter->id;
                    $newFilterValue->value = $value;
                    $newFilterValue->save();
                }

            }


        }
    }

}
