@extends('layout')

@section('content')
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
                <h4 class=""><span class="text-muted fw-light">Покупатели</h4>


                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Имя</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($accounts as $account)
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ $account->id }}</span>
                                    </td>
                                    <td>{{ $account->fio }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('edit account')
                                                    <a class="dropdown-item" href="{{ route('admin.accounts.edit', $user->id) }}">
                                                        <i class="ti ti-pencil me-1"></i> Редактировать</a>
                                                @endcan

                                                @can('delete account')
                                                    <a class="dropdown-item" href="{{ route('admin.accounts.destroy', $user->id) }}">
                                                        <i class="ti ti-trash me-1"></i> Удалить</a>
                                                @endcan
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

@endsection
