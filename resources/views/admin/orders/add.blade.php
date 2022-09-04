@extends('admin.layouts.admin')

@section('title', 'Добавить направление')

@section('content')

    <!-- general form elements disabled -->
    <div class=" card-warning">
        <!-- /.card-header -->
        <div class="card-body">
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
            <form action="{{ route('exchanges.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title страницы</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Символьный код</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Выберите направление</label>
                            <input type="text" name="currency_from" class="form-control" required>
                            <input type="text" name="currency_to" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Минимальная сумма</label>
                            <input type="text" name="min" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Максимальная сумма</label>
                            <input type="text" name="max" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Добавить</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
