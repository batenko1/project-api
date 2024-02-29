@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Товары /</span> Редактировать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post"
                                  enctype="multipart/form-data"
                                  action="{{ route('admin.products.update', $product->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('title')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('title') ?? $product->title }}" name="title"/>
                                        @if($errors->first('title'))
                                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Категория</label>
                                    <div class="col-sm-10">
                                        <select id="multicol-country" name="entity_id"
                                                class="select2 form-select @if($errors->first('entity_id')) is-invalid @endif"
                                                data-allow-clear="true">
                                            @foreach($entities as $entity)
                                                @if(!$entity->child->count())
                                                    <option
                                                        @if($entity->id == $product->id) selected @endif
                                                        value="{{ $entity->id }}">{{ $entity->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if($errors->first('entity_id'))
                                            <div class="invalid-feedback">{{ $errors->first('entity_id') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @if($errors->first('price')) is-invalid @endif"
                                               id="basic-default-name" name="price" value="{{ old('price')?? $product->price }}" />
                                        @if($errors->first('price'))
                                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Фильтры</label>

                                    <div class="col-sm-10">
                                        <div class="filters-wrap">
                                            {!! $html !!}
                                        </div>
                                    </div>

                                </div>



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
        $('#multicol-country').change(function() {
            let el = $(this)

            let val = el.val()

            if(val) {

                $.ajax({
                    type: 'get',
                    url: '/api/products/get-filters/' + val,
                    success:function(result) {
                        $('.filters-wrap').html(result)
                    }
                })

            }

        })

        // $('#multicol-country').trigger('change')

    </script>
@endsection
