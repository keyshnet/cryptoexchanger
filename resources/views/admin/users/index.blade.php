@extends('admin.layouts.admin')

@section('title', 'Пользователи')

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
                    <th style="width: 30%">Email</th>
                    <th style="width: 30%">Дата регистрация</th>
                    <th style="width: 20%">Роль</th>
                    <th style="width: 0%">Заявок</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->orders->count() }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
