@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Роли /</span> Создать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.roles.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('name')) is-invalid @endif"
                                               id="basic-default-name"
                                               value="{{ old('name') }}" name="name"/>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Права</label>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary btn-select-all"
                                                style="display: block; margin-bottom: 10px;">Выбрать все</button>
                                        @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $permission->id }}"
                                                       id="defaultCheck3">
                                                <label class="form-check-label" for="defaultCheck3"> {{ $permission->title }} </label>
                                            </div>
                                        @endforeach

                                        @if($errors->first('permissions'))
                                                <div class="invalid-feedback">{{ $errors->first('permissions') }}</div>
                                        @endif
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
        $('.btn-select-all').click(function(e) {

            e.preventDefault()

            let first = $($('.form-check-input')[0])

            if(first.prop('checked')) {
                $('.form-check-input').prop('checked', false)
            }
            else {
                $('.form-check-input').prop('checked', true)
            }



        })
    </script>
@endsection
