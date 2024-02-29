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
            <h4 class=""><span class="text-muted fw-light">Пользователи</h4>
            @can('create user')
            <a href="{{ route('admin.users.create') }}"
               class="btn btn-primary waves-effect waves-light mb-4">Создать</a>
            @endcan

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap" style="padding: 20px">
                    <table class="table dataTable-js">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Имя</th>
                            <th>Почта</th>
                            <th>Роль</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $user->id }}</span>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->first() }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('edit user')
                                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">
                                                <i class="ti ti-pencil me-1"></i> Редактировать</a>
                                            @endcan

                                            @if($user->getRoleNames()->first() != 'admin')
                                            @can('delete user')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
        $('.dataTable-js').DataTable()
    </script>
@endsection
