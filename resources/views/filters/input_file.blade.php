<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="basic-default-name">{{ $filter->title }} / {{ $filter->alias }}</label>

    <div class="col-sm-9">
        <input type="file" class="form-control"
               id="basic-default-name"
               name="filter_{{ $filter->id }}"/>

        @if(isset($product) && $product->values->where('filter_id', $filter->id)->first())
            <img
                style="display:block; margin-top: 10px"
                src="{{ asset('storage/'. $product->values->where('filter_id', $filter->id)->first()->value) }}"
                 width="100" alt="">
        @endif
    </div>


</div>
