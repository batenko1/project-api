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



            $title = $request->filter_name[$key];

            $newFilter = new Filter();

            if (property_exists($filter, 'id')) {
                $newFilter = Filter::query()->where('id', $filter->id)->first();
            }

            $newFilter->entity_id = $entity->id;
            $newFilter->title = $title;
            $newFilter->type = $filter;
            $newFilter->is_required = $filter->is_required ?? 0;
            $newFilter->is_default = $filter->is_default ?? 0;

            $newFilter->save();

            if (property_exists($filter, 'values')) {

                $values = $filter->values;

                foreach ($values as $value) {

                    if(!FilterValue::query()->where('filter_id', $newFilter->id)
                        ->where('value', $value)
                        ->first()) {
                        FilterValue::query()->create([
                            'filter_id' => $newFilter->id,
                            'value' => $value
                        ]);
                    }
                }

            }

        }
    }

}
