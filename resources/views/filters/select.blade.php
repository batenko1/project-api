@php

    if(isset($product) && $product->values->where('filter_id', $filter->id)->count() > 0) {
        $listValues = $product->values->where('filter_id', $filter->id)->pluck('filter_value_id')->toArray();
    }

@endphp

<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="multicol-country">{{ $filter->title }} / {{ $filter->alias }}</label>
    <div class="col-sm-9">
        <select name="{{$name ?? ''}}filter_{{ $filter->id }}[]" class="select2 form-select" data-allow-clear="true" multiple>
            @foreach($filter->values as $value)
                <option
                    @if(isset($product) && isset($listValues) && in_array($value->id, $listValues))
                        @if(in_array($value->id, $listValues)) selected @endif
                    @endif
                    value="{{ $value->id }}">{{ $value->value }}</option>
            @endforeach

        </select>
    </div>
</div>
