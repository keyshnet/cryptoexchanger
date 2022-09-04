@extends('admin.layouts.admin')

@section('title', 'Баннеры')

@section('title_block')
    <a href="{{ route('banners.create') }}" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Добавить баннер </a>
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
        <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th style="width: 20%">Название</th>
            <th style="width: 30%">Активен</th>
            <th style="width: 20%"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($banners as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}<br/> <small>Создана {{ $item->created_at->format('d.m.Y в H:i') }}</small></td>
            <td>{{ $item->active ? 'Да': 'Нет' }}</td>
            <td class="project-actions text-right">
                <a class="btn btn-info btn-sm" href="{{ route('banners.edit', $item->id) }}">
                    <i class="fas fa-pencil-alt"></i> Редактировать
                </a>
                <form method="POST" action="{{ route('banners.destroy', $item->id) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn-sm delete-btn" href="{{ route('banners.destroy', $item->id) }}"
                       onclick="event.preventDefault();
                                if(!confirm('Удалить страницу?')) return false;
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
