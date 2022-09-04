@extends('admin.layouts.admin')

@section('title', 'Статические страницы')

@section('title_block')
    <a href="{{ route('pages.create') }}" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Добавить статью </a>
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
                    <th style="width: 30%">Символьный код</th>
                    <th style="width: 20%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->name }}<br/> <small>Создана {{ $page->created_at->format('d.m.Y в H:i') }}</small></td>
                    <td>{{ $page->code }}</td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ url('/').'/'.$page->code }}" target="_blank">
                            <i class="fas fa-folder"></i> Посмотреть
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ route('pages.edit', $page->id) }}">
                            <i class="fas fa-pencil-alt"></i> Редактировать
                        </a>
                        <form method="POST" action="{{ route('pages.destroy', $page->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger btn-sm delete-btn" href="{{ route('pages.destroy', $page->id) }}"
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
