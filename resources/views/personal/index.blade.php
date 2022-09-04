@extends('layouts.public')

@section('title', __('Личный кабинет'))

@section('content')
    <div id="main" class="without-sidebar">
        <div>
            <h1 class="breadcrumb_title" id="the_title_page" itemprop="title">{{ __('Последние обмены') }}</h1>
        </div>

        <div class="container narrow">
            <div class="text">
                <div class="userxchtable pntable_wrap">
                    <div class="userxchtable_ins pntable_wrap_ins">
                        <div class="userxch_table pntable">
                            <div class="userxch_table_ins pntable_ins">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="th_id">{{ __('№ операции') }}</th>
                                        <th class="th_date">{{ __('Дата операции') }}</th>
                                        <th class="th_give">{{ __('Сумма перевода') }}</th>
                                        <th class="th_get">{{ __('Сумма получения') }}</th>
                                        <th class="th_status">{{ __('Статус') }}</th>
                                        <th class=""></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @empty($items)
                                        <tr>
                                            <td colspan="6"><div class="no_items"><div class="no_items_ins">{{ __('Вы не совершали еще обмены') }}</div></div></td>
                                        </tr>
                                    @else
                                        @foreach($items as $item)
                                        <tr>
                                            <td>№{{ $item->id }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><img src="{{asset($item->currencyFrom->image)}}" alt="" width="20" height="20"><h5>{{ $item->summ_from }} {{ strtoupper($item->currencyFrom->code) }}</h5></td>
                                            <td><img src="{{asset($item->currencyTo->image)}}" alt="" width="20" height="20"><h5>{{ $item->summ_to }} {{ strtoupper($item->currencyTo->code) }}</h5></td>
                                            <td>{{ $item->statusInfo->value }}</td>
                                            <td><a href="{{ route('order.show', $item->id) }}" class="btn btn-link">
                                                    {{ __('Посмотреть') }}
                                                </a></td>
                                        </tr>
                                        @endforeach
                                    @endempty

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
