<?php

namespace App\Services;

use App\Models\Filter;
use App\Models\FilterValue;

class StoreFilters
{

    public static function save($entity, $request)
    {

        $filters = $request->filter_type;


        foreach ($filters as $key => $filter) {

            if(!$filter) {
                continue;
            }


            $title = $request->filter_name[$key];
            $alias = $request->filter_alias[$key];


            $newFilter = Filter::query()->where('id', $key)->first();

            if(!$newFilter) {
                $newFilter = new Filter();
            }

            $newFilter->entity_id = $entity->id;
            $newFilter->title = $title;
            $newFilter->alias = $alias;
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

    public static function saveEntity($entity, $request)
    {

        $filters = $request->filter_entity_type;


        foreach ($filters as $key => $filter) {

            if(!$filter) {
                continue;
            }


            $title = $request->filter_entity_name[$key];
            $alias = $request->filter_entity_alias[$key];



            $newFilter = Filter::query()->where('id', $key)->first();

            if(!$newFilter) {
                $newFilter = new Filter();
            }

            $newFilter->is_entity = 1;
            $newFilter->entity_id = $entity->id;
            $newFilter->title = $title;
            $newFilter->alias = $alias;
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
