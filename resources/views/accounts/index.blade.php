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
                <div class="table-responsive text-nowrap" style="padding: 20px">
                    <table class="table dataTable-js">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Дата создания</th>
                            <th>Имя</th>
                            <th>ИНН</th>
                            <th>Верификация</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($accounts as $account)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $account->id }}</span>
                                </td>
                                <td>{{ $account->created_at->format('d.m.Y') }}</td>
                                <td>{{ $account->fio }}</td>
                                <td>{{ $account->identification_code }}</td>
                                @if($account->is_verified)
                                    <td><span class="badge bg-success">да</span></td>
                                @else
                                    <td><span class="badge bg-danger">нет</span></td>
                                @endif


                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item"
                                               href="{{ route('admin.accounts.show', $account->id) }}">
                                                <i class="ti ti-pencil me-1"></i> Посмотреть</a>

                                            {{--                                            @can('edit account')--}}
                                            {{--                                                <a class="dropdown-item"--}}
                                            {{--                                                   href="{{ route('admin.accounts.edit', $account->id) }}">--}}
                                            {{--                                                    <i class="ti ti-pencil me-1"></i> Редактировать</a>--}}
                                            {{--                                            @endcan--}}

                                            {{--                                            @can('delete account')--}}
                                            {{--                                                <a class="dropdown-item"--}}
                                            {{--                                                   href="{{ route('admin.accounts.destroy', $account->id) }}">--}}
                                            {{--                                                    <i class="ti ti-trash me-1"></i> Удалить</a>--}}
                                            {{--                                            @endcan--}}
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
