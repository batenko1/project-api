<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="basic-default-name">{{ $filter->title }} / {{ $filter->alias }}</label>

    <div class="col-sm-9">
        <input type="file" class="form-control" multiple
               id="basic-default-name"
               name="{{$name ?? ''}}filter_{{ $filter->id }}[]"/>

        @if(isset($product) && $product->values->where('filter_id', $filter->id)->first())
            @if(json_decode($product->values->where('filter_id', $filter->id)->first()->value))
                @foreach(json_decode($product->values->where('filter_id', $filter->id)->first()->value) as $img)
                    <img
                        style="display:inline-block; margin-top: 10px"
                        src="{{ asset('storage/'. $img) }}"
                        width="100" alt="">
                @endforeach
            @endif

        @endif
    </div>


</div>
