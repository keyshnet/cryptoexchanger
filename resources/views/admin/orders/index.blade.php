@extends('admin.layouts.admin')

@section('title', 'Заявки на обмен')

@section('content')
    <div class="row mb-3">
        <div class="col">
            @foreach($statuses as $status)
                <a href="{{ route('orders.index', 'status='.$status->code) }}" class="btn @if($route_status == $status->code) bg-gradient-success @else bg-gradient-primary @endif">{{ $status->value }}</a>
            @endforeach
{{--            <a href="{{ route('orders.index', 'status=all') }}" class="btn @if($route_status == "all") bg-gradient-success @else bg-gradient-primary @endif">Все</a>--}}
        </div>
    </div>
<div class="card  card-primary card-outline">
    <div class="card-body p-0">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <div><i class="icon fa fa-check"></i> {{ session('success') }}</div>
        </div>
        <script defer>
            window.onload = function() {
                $('.alert').delay(1000).slideUp(300);
            };
        </script>
    @endif
    <table class="table table-striped projects">
        <thead>
        <tr>
            <th style="width: 1%">№ заявки</th>
            <th style="width: 20%">Дата заявки</th>
            <th style="width: 20%">Сумма перевода</th>
            <th style="width: 20%">Сумма получения</th>
            <th style="width: 10%">Статус</th>
            <th style="width: 30%"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->summ_from }} {{ strtoupper($item->currencyFrom->code) }} </td>
            <td>{{ $item->summ_to }} {{ strtoupper($item->currencyTo->code) }} </td>
            <td>{{ $item->statusInfo->value }}</td>
            <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('orders.show', $item->id) }}">
                    <i class="fas fa-folder"></i> Посмотреть
                </a>
                <a class="btn btn-info btn-sm" href="{{ route('orders.edit', $item->id) }}">
                    <i class="fas fa-pencil-alt"></i> Редактировать
                </a>
                <form method="POST" action="{{ route('orders.destroy', $item->id) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn-sm delete-btn" href="{{ route('orders.destroy', $item->id) }}"
                       onclick="event.preventDefault();
                                if(!confirm('Удалить заявку?')) return false;
                                this.closest('form').submit();">
                        <i class="fas fa-trash"></i> {{ __('Удалить') }}
                    </a>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
