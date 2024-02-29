@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css/rtl/core.css') }}"
          class="template-customizer-core-css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
          class="template-customizer-theme-css">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4><span class="text-muted fw-light">Настройки</h4>

            @can('create setting')
                <a href="{{ route('admin.settings.create') }}"
                   class="btn btn-primary waves-effect waves-light mb-4">Создать</a>
            @endcan

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap" style="padding: 20px;">
                    <table class="table dataTable-js">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Имя</th>
                            <th>Ключ</th>
                            <th>Значение</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($settings as $setting)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $setting->id }}</span>
                                </td>
                                <td>{{ $setting->title }}</td>
                                <td>{{ $setting->key }}</td>
                                <td>{{ $setting->value }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            @can('edit setting')
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.settings.edit', $setting->id) }}">
                                                    <i class="ti ti-pencil me-1"></i> Редактировать</a>
                                            @endcan

                                            @if(!$setting->is_not_deleted)
                                                @can('delete user')
                                                    <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item">
                                                            <i class="ti ti-trash me-1"></i> Удалить</button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->

        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('js')
    <script>
        $('.dataTable-js').DataTable({order: [[0, 'desc']]})
    </script>
@endsection
