@php
    $time = time().\Str::random(10);

    if(isset($filter)) {
        $time = $filter->id;
    }
@endphp

<div class="one-filter mt-3">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <select

                @if(isset($filter)) disabled @endif

                class="select2 form-select type-filter"
                name="filter_{{ $name ?? '' }}type[{{$time}}]"
                data-allow-clear="true">
                <option value="">Тип фильтра</option>

                @foreach(\App\Models\Filter::FIELDS as $filterEl)
                    <option @if(isset($filter) && $filter->type == $filterEl) selected @endif
                    value="{{ $filterEl }}">{{ $filterEl }}</option>
                @endforeach

            </select>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" placeholder="Название фильтра"
                   name="filter_{{ $name ?? '' }}name[{{$time}}]"
                   @if(isset($filter)) value="{{ $filter->title }}" @endif
                   id="basic-default-name"/>
        </div>

        <div class="col-sm-2">
            <input type="text" class="form-control" placeholder="Алиас"
                   name="filter_{{ $name ?? '' }}alias[{{$time}}]"
                   @if(isset($filter)) value="{{ $filter->alias }}" @endif
                   id="basic-default-name"/>
        </div>


        @if(isset($filter) && $filter->type == 'select')
            <div class="col-sm-2 select-values">
                <input type="text" class="form-control"
                       placeholder="Значения(указывать через запятую)"
                       name="filter_{{ $name ?? '' }}values[{{$time}}]"
                       value="{{ implode(',', $filter->values->pluck('value')->toArray()) }}"
                       id="basic-default-name"/>
            </div>

        @else
            <div class="col-sm-2 d-none select-values">
                <input type="text" class="form-control"
                       placeholder="Значения(указывать через запятую)"
                       name="filter_{{ $name ?? '' }}values[{{$time}}]"
                       id="basic-default-name"/>
            </div>
        @endif



        <div class="col-sm-2">
            <a href="javascript:void(0);"
               class="btn btn-primary btn-delete-filter" @if(isset($filter)) data-id="{{ $filter->id }}" @endif>Удалить</a>
        </div>
    </div>

</div>
