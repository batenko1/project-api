<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="multicol-country">{{ $filter->title }}</label>
    <div class="col-sm-9">
        <select name="filter_{{ $filter->id }}" class="select2 form-select" data-allow-clear="true">
            @foreach($filter->values as $value)
                <option
                    @if(isset($product) && $product->values->where('filter_id', $filter->id)->first())
                        @if($product->values->where('filter_id', $filter->id)->first()->filter_value_id == $value->id) selected @endif
                    @endif
                    value="{{ $value->id }}">{{ $value->value }}</option>
            @endforeach

        </select>
    </div>
</div>
