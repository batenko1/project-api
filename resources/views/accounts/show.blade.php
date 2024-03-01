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
                                <dt class="col-sm-3">ФИО</dt>
                                <dd class="col-sm-9">{{ $account->fio }}</dd>

                                <dt class="col-sm-3">ИНН</dt>
                                <dd class="col-sm-9">
                                    <p>{{ $account->identification_code }}</p>
                                </dd>

                                <dt class="col-sm-3">Верификация</dt>
                                <dd class="col-sm-9"><span class="badge bg-info">{{ $account->is_verified ? 'Да' : 'Нет' }}</span></dd>

                                <dt class="col-sm-3 text-truncate">Дата создания</dt>
                                <dd class="col-sm-9">{{ $account->created_at->format('d.m.Y') }}</dd>

                                <dt class="col-sm-3">Фотографии</dt>
                                <dd class="col-sm-8">
                                    @foreach($account->photos as $photo)

                                        <div style="display:inline-block">
                                            <img src="{{ asset('storage/'. $photo->image) }}" width="150" style="display:inline-block; margin-bottom: 10px;" alt="">
                                            @if($photo->is_verified)
                                                <span class="badge bg-success" style="display: block; width:max-content;">Верифицирован</span>
                                            @else
                                                <span class="badge bg-danger" style="display: block; width:max-content;">Не верифицирован</span>
                                            @endif
                                        </div>

                                    @endforeach
                                </dd>

                                <dt class="col-sm-3">Бонусы</dt>
                                <div class="col-sm-8">

                                    {{ $bonuses->sum('bonuses') }}

                                    <table>
                                        <tr>
                                            <td>Количество</td>
                                            <td>Тип расчета</td>
                                        </tr>

                                        @foreach($bonuses as $bonus)

                                            <tr>
                                                <td>{{ $bonus->bonuses }}</td>
                                                <td>{{ $bonus->type == 'add' ? 'Начислено' : 'Снято' }}</td>
                                            </tr>

                                        @endforeach

                                    </table>

                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
