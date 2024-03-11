@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Роли /</span> Редактировать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               class="form-control @if($errors->first('name')) is-invalid @endif"
                                               id="basic-default-name"
                                               value="{{ old('name') ?? $role->name }}" name="name"/>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Права</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @foreach($permissions->whereNotNull('title')->chunk(5) as $wrapPermissions)
                                                {{--                                            @if(!$permission->title)--}}
                                                {{--                                                @continue--}}
                                                {{--                                            @endif--}}


                                                <div class="col-sm-5" style="border:1px solid #ccc; margin: 10px; padding: 10px;">
                                                    @foreach($wrapPermissions as $permission)

                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                   @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked
                                                                   @endif
                                                                   name="permissions[]" type="checkbox"
                                                                   value="{{ $permission->id }}"
                                                                   id="defaultCheck3">
                                                            <label class="form-check-label"
                                                                   for="defaultCheck3"> {{ $permission->title }} </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            @endforeach
                                        </div>

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

                            <form
                                style="float:right;"
                                action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item">
                                    <i class="ti ti-trash me-1"></i> Удалить
                                </button>
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
