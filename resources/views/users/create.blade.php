@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Пользователи /</span> Создать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.users.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->first('name')) is-invalid @endif"
                                               id="basic-default-name"
                                               value="{{ old('name') }}" name="name"/>
                                        @if($errors->first('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Почта</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control @if($errors->first('email')) is-invalid @endif"
                                               id="basic-default-name" value="{{ old('email') }}" name="email" />
                                        @if($errors->first('email'))
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Пароль</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @if($errors->first('password')) is-invalid @endif"
                                               id="basic-default-name" name="password" />
                                        @if($errors->first('password'))
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="multicol-country">Роль</label>
                                    <div class="col-sm-10">
                                        <select id="multicol-country" name="role_id"
                                                class="select2 form-select @if($errors->first('role_id')) is-invalid @endif"
                                                data-allow-clear="true">
                                            <option value="">Укажите роль</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->first('role_id'))
                                            <div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Создать</button>
                                        <button type="submit" value="1" name="submit_and_reload" class="btn btn-primary">Создать и обновить</button>
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
