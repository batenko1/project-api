<div class="one-filter">
    <div class="col-sm-4">
        <select
            class="select2 form-select"
            name="filter_type[]"
            data-allow-clear="true">
            <option value="">Тип фильтра</option>

            @foreach(\App\Models\Filter::FIELDS as $filter)
                <option value="{{ $filter }}">{{ $filter }}</option>
            @endforeach

        </select>
    </div>
    <div class="col-sm-4">
        <input type="text" class="form-control" placeholder="Название фильтра"
               name="filter_name[]"
               id="basic-default-name"/>
    </div>
    <div class="col-sm-2">
        <a href="javascript:void(0);" class="btn btn-primary btn-delete-filter">Удалить</a>
    </div>
</div>
