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
            <h4><span class="text-muted fw-light">Страницы</span></h4>
            @can('create template')
                <a href="{{ route('admin.pages.create') }}"
                   class="btn btn-primary waves-effect waves-light mb-4">Создать</a>
            @endcan

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap" style="padding: 20px">
                    <table class="table dataTable-js">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Заголовок</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $page->id }}</span>
                                </td>
                                <td>{{ $page->title }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            @can('edit page')
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.pages.edit', $page->id) }}">
                                                    <i class="ti ti-pencil me-1"></i> Редактировать</a>
                                            @endcan

                                            @can('delete page')
                                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item">
                                                        <i class="ti ti-trash me-1"></i> Удалить</button>
                                                </form>
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
