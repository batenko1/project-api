@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">

                        <div class="card-body">
                            <small class="text-light fw-medium">Информация</small>
                            <dl class="row mt-2">


                                <dt class="col-sm-3">Статус заказа</dt>
                                <dd class="col-sm-9">
                                    <p><span class="badge bg-info">{{ $order->status }}</span></p>
                                </dd>

                                <dt class="col-sm-3">Верифицирован ли шаблон</dt>
                                <dd class="col-sm-9">
                                    <p>
                                        @if($order->is_agree)
                                            <span class="badge bg-success">Да</span>
                                        @else
                                            <span class="badge bg-danger">Нет</span>
                                        @endif
                                    </p>
                                </dd>

                                <dt class="col-sm-3">ФИО</dt>
                                <dd class="col-sm-9">
                                    <p>{{ $order->account->fio }}</p>
                                </dd>

                                <dt class="col-sm-3">ИНН</dt>
                                <dd class="col-sm-9">
                                    <p>{{ $order->account->identification_code }}</p>
                                </dd>

                                <dt class="col-sm-3">Полная стоимть</dt>
                                <dd class="col-sm-9">
                                    <p>{{ $order->price }}</p>
                                </dd>

                               <dt class="col-sm-3 text-truncate">Дата создания</dt>
                                <dd class="col-sm-9">{{ $order->created_at->format('d.m.Y') }}</dd>


                                <dt class="col-sm-3 text-truncate">Товары</dt>
                                <dd class="col-sm-9">
                                    <table class="table">
                                        <tr>
                                            <th>Название</th>
                                            <th>Стоимость</th>
                                            <th>Стоимость за единицу</th>
                                            <th>Количество</th>
                                        </tr>
                                        @foreach($order->products as $product)
                                            <tr>
                                                <td>{{ $product->title }}</td>
                                                <td>{{ $product->pivot->price }}</td>
                                                <td>{{ $product->pivot->price_for_one }}</td>
                                                <td>{{ $product->pivot->count }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
