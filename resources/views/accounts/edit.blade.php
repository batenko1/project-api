@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Пользователь /</span> Редактировать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post"
                                  enctype="multipart/form-data"
                                  action="{{ route('admin.accounts.update', $account->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">ФИО</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('fio')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('fio') ?? $account->fio }}" name="fio" required/>
                                        @if($errors->first('fio'))
                                            <div class="invalid-feedback">{{ $errors->first('fio') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">ИНН</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('identification_code')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('identification_code') ?? $account->identification_code }}"
                                               name="identification_code" required/>
                                        @if($errors->first('identification_code'))
                                            <div class="invalid-feedback">{{ $errors->first('identification_code') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Верифицировать</label>
                                    <div class="col-sm-10">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="1" name="is_verified"
                                                   @if($account->is_verified) checked @endif
                                                   id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1"> Да </label>
                                        </div>
                                        @if($errors->first('is_verified'))
                                            <div class="invalid-feedback">{{ $errors->first('is_verified') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Изображения</label>
                                    @foreach($account->photos as $photo)

                                        <div style="display:inline-block; width:200px;">
                                            <img src="{{ asset('storage/'. $photo->image) }}" width="150" style="display:inline-block; margin-bottom: 10px;" alt="">
                                            @if($photo->is_verified)
                                                <span class="badge bg-success" style="display: block; width:max-content;">Верифицирован</span>
                                            @else
                                                <span class="badge bg-danger" style="display: block; width:max-content;">Не верифицирован</span>
                                            @endif
                                        </div>

                                    @endforeach
                                </div>



                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Редактировать</button>

                                    </div>
                                </div>
                            </form>
                            @can('account delete')
                            <form
                                style="float:right;"
                                action="{{ route('admin.accounts.destroy', $account->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item">
                                    <i class="ti ti-trash me-1"></i> Удалить</button>
                            </form>
                            @endcan
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
