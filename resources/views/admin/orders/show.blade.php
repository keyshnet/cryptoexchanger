@extends('admin.layouts.admin')

@section('title', 'Заявки №'.$item->id)

@section('title_block')
    <a href="{{ route('orders.index') }}" class="btn  btn-dark float-sm-right">назад </a>
@endsection

@section('content')
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
        <tbody>
            <tr>
                <td width="30%" class="text-bold">№ заявки</td>
                <td>{{ $item->id }}</td>
            </tr>
            <tr>
                <td class="text-bold">Дата создания</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            <tr>
                <td class="text-bold">Сумма перевода</td>
                <td>{{ $item->summ_from }} {{ strtoupper($item->currencyFrom->code) }} </td>
            </tr>
            <tr>
                <td class="text-bold">Сумма получения </td>
                <td>{{ $item->summ_to }} {{ strtoupper($item->currencyTo->code) }} </td>
            </tr>
            <tr>
                <td class="text-bold">Статус</td>
                <td>{{ $item->status }}</td>
            </tr>
            <tr>
                <td class="text-bold">С кошелька</td>
                <td>{{ $item->wallet_from }}</td>
            </tr>
            <tr>
                <td class="text-bold">На кошелек</td>
                <td>{{ $item->wallet_to }}</td>
            </tr>
            <tr>
                <td class="text-bold">Пользователь</td>
                <td>{{ Auth::user($item->user_id)->email }} (id: {{ Auth::user($item->user_id)->id }})</td>
            </tr>
            <tr>
                <td class="text-bold">ФИО</td>
                <td>{{ $item->fio }}</td>
            </tr>
            <tr>
                <td class="text-bold">Email</td>
                <td>{{ $item->email }}</td>
            </tr>
            <tr>
                <td class="project-actions text-right" colspan="2">
                    <a class="btn btn-info btn-sm" href="{{ route('orders.edit', $item->id) }}">
                        <i class="fas fa-pencil-alt"></i> Редактировать
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection
