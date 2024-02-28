<div class="row mb-3">
    <label class="col-sm-3 col-form-label" for="multicol-country">{{ $filter->title }}</label>
    <div class="col-sm-9">
        <select name="filter_{{ $filter->id }}" class="select2 form-select" data-allow-clear="true">
            <option value=""></option>
        </select>
    </div>
</div>
