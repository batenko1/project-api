<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="basic-default-name">{{ $filter->title }}</label>

    <div class="col-sm-9">
        <input type="date" class="form-control"
               id="basic-default-name"
               @if(isset($product) && $product->values->where('filter_id', $filter->id)->first())
                   value="{{ $product->values->where('filter_id', $filter->id)->first()->value }}"
               @endif
               name="filter_{{ $filter->id }}"/>
    </div>


</div>
