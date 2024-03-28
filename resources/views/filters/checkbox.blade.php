<div class="row mb-3">
    <label class="form-check m-0">
        <input type="checkbox"
               @if(isset($product) && $product->values->where('filter_id', $filter->id)->first())
                   @if($product->values->where('filter_id', $filter->id)->first()->value) checked @endif
               @endif
               class="form-check-input"
                value="1"
               name="{{$name ?? ''}}filter_{{ $filter->id }}" />
        <span class="form-check-label">{{ $filter->title }} / {{$filter->alias}}</span>
    </label>
</div>
