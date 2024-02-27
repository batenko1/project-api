@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Категории /</span> Создать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.entities.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('title')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('title') }}" name="title"/>
                                        @if($errors->first('title'))
                                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="multicol-country">Родительская категория</label>
                                    <div class="col-sm-10">
                                        <select id="multicol-country"
                                                name="parent_id"
                                                class="select2 form-select @if($errors->first('parent_id')) is-invalid @endif"
                                                data-allow-clear="true">
                                            <option value="">Укажите родителя</option>
                                            @foreach($entities as $entity)
                                                <option value="{{ $entity->id }}">{{ $entity->title }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->first('parent_id'))
                                            <div class="invalid-feedback">{{ $errors->first('parent_id') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="multicol-country">Фильтры</label>
                                    <div class="col-sm-3">
                                        <select id="multicol-country1"
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
                                    <div class="col-sm-3">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-create-filter">Добавить фильтр</a>
                                    </div>
                                </div>

                                <hr>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Создать</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

    <script>
        $(document).ready(function() {
           $('.btn-create-filter').click(function() {

           })
        })
    </script>
@endsection
