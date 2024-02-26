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
                <h4><span class="text-muted fw-light">Заказы</h4>

                <a href="{{ route('admin.entities.create') }}"
                   class="btn btn-primary waves-effect waves-light mb-4">Создать</a>

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
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ $order->id }}</span>
                                    </td>
                                    <td>{{ $order->title }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.orders.edit', $order->id) }}"
                                                ><i class="ti ti-pencil me-1"></i> Редактировать</a>
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.orders.destroy', $order->id) }}"
                                                ><i class="ti ti-trash me-1"></i> Удалить</a>
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
