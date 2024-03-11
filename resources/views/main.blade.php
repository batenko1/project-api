@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col-xl-12 mb-4 col-lg-7 col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title mb-0">Статистика</h5>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                            <i class="ti ti-chart-pie-2 ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ \App\Models\Account::count() }}</h5>
                                            <small>Количество покупателей</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                                            <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ \App\Models\Order::query()->count() }}</h5>
                                            <small>Количество заказов</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                            <i class="ti ti-shopping-cart ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ \App\Models\Product::query()->count() }}</h5>
                                            <small>Количество товаров</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-currency-dollar ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ \App\Models\Entity::query()->count() }}</h5>
                                            <small>Количество категорий</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 order-2 order-lg-1 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="mb-0">Последние заказы</h5>
{{--                                <small class="text-muted">38.4k Visitors</small>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                @foreach(\App\Models\Order::query()->orderBy('created_at', 'desc')->take(10)->get() as $order)
                                    <li class="mb-3 pb-1">
                                        <div class="d-flex align-items-start">
                                            <div class="badge bg-label-secondary p-2 me-3 rounded">
                                                <i class="ti ti-shadow ti-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $order->fio }}</h6>
{{--                                                    <small class="text-muted">Direct link click</small>--}}
                                                </div>
                                                <div class="d-flex align-items-center">
{{--                                                    <p class="mb-0">1.2k</p>--}}
                                                    <div class="ms-3 badge bg-label-success">{{ $order->price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection
