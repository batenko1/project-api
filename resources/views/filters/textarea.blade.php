<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="basic-default-name">{{ $filter->title }}</label>

    <div class="col-sm-9">
        <textarea class="form-control" name="filter_{{ $filter->id }}"
        >@if(isset($product) && $product->values->where('filter_id', $filter->id)->first()){{ $product->values->where('filter_id', $filter->id)->first()->value }}
            @endif</textarea>
    </div>


</div>
