@php
    $time = time();
@endphp

<div class="one-filter">
    <div class="col-sm-3">
        <select
            class="select2 form-select type-filter"
            name="filter_type[{{$time}}]"
            data-allow-clear="true">
            <option value="">Тип фильтра</option>

            @foreach(\App\Models\Filter::FIELDS as $filter)
                <option value="{{ $filter }}">{{ $filter }}</option>
            @endforeach

        </select>
    </div>
    <div class="col-sm-3">
        <input type="text" class="form-control" placeholder="Название фильтра"
               name="filter_name[{{$time}}]"
               id="basic-default-name"/>
    </div>

    <div class="col-sm-2">
        <input type="text" class="form-control d-none"
               placeholder="Значения(указывать через запятую)"
               name="filter_values[{{$time}}]"
               id="basic-default-name"/>
    </div>

    <div class="col-sm-2">
        <a href="javascript:void(0);" class="btn btn-primary btn-delete-filter">Удалить</a>
    </div>

</div>
