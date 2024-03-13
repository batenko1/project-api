@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Настройки /</span> Создать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.settings.store') }}">
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
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Ключ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('key')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('key') }}" name="key"/>
                                        @if($errors->first('key'))
                                            <div class="invalid-feedback">{{ $errors->first('key') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Значение</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('value')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('value') }}" name="value"/>
                                        @if($errors->first('value'))
                                            <div class="invalid-feedback">{{ $errors->first('value') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Создать</button>
                                        <button type="submit" name="submit_and_reload" class="btn btn-primary">Создать и обновить</button>
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
@endsection
