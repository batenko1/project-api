@foreach($filters as $filter)

    @include('filters.'.$filter->type)

@endforeach
