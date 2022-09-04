@extends('admin.layouts.admin')

@section('title', 'Добавить статическую страницу')

@section('content')
    <div class="card  card-primary card-outline">
        <div class="card-body p-0">
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
        <form action="{{ route('pages.store') }}" method="POST">
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
                        <label>Символьный код(адрес страницы)</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Слоган</label>
                        <input type="text" name="slogan" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Текст на странице</label>
                        <textarea class="form-control" name="content" rows="3"></textarea>
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
        </div>
    </div>
@endsection
