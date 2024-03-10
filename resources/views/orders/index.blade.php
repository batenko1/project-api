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

            {{--                @can('create order')--}}
            {{--                <a href="{{ route('admin.orders.create') }}"--}}
            {{--                   class="btn btn-primary waves-effect waves-light mb-4">Создать</a>--}}
            {{--                @endcan--}}

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap" style="padding:20px;">
                    <table class="table dataTable-js">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Дата заказа</th>
                            <th>Имя</th>
                            <th>Покупатель</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Подтвержден ли документ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $order->id }}</span>
                                </td>
                                <td>{{ $order->created_at->format('d.m.Y') }}</td>
                                <td>{{ $order->fio }}</td>
                                <td>
                                    <a href="{{ route('admin.accounts.show', $order->account_id) }}"
                                       target="_blank">Посмотреть</a>
                                </td>
                                <td>{{ $order->price }}</td>
                                <td><span class="badge bg-info">{{ $order->status }}</span></td>
                                @if($order->is_agree)
                                    <td>
                                        <span class="badge bg-success">Да</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge bg-danger">Нет</span>
                                    </td>
                                @endif

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('edit order')
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.orders.edit', $order->id) }}">
                                                    <i class="ti ti-pencil me-1"></i> Редактировать</a>
                                            @endcan

                                            @can('delete order')
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.orders.destroy', $order->id) }}">
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

@section('js')
    <script>
        $('.dataTable-js').DataTable({
            order: [[0, 'desc']],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json"
            }
        })
    </script>
@endsection
