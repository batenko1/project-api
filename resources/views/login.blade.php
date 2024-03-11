@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}"/>
@endsection

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                      @if(\App\Models\Setting::query()->where('key', 'logo')->first())
                          <img
                              src="{{ asset('storage/'. \Str::replace('public', '', \App\Models\Setting::query()->where('key', 'logo')->first()->value)) }}"
                              alt="">
                      @endif
                  </span>
                                {{--                                <span class="app-brand-text demo text-body fw-bold ms-1">Vuexy</span>--}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Добро пожаловать 👋</h4>
                        <p class="mb-4">Пожалуйста укажите данные для входа</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Почта</label>
                                <input
                                    type="text"
                                    class="form-control @if($errors->first('email')) is-invalid @endif"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Введите свою почту"
                                    autofocus/>
                                @if($errors->first('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control @if($errors->first('password')) is-invalid @endif"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @if($errors->first('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

@endsection
