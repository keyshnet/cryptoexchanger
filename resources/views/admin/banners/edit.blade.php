@extends('admin.layouts.admin')

@section('title', 'Редактировать баннер: ' . $banner["name"])

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

        <form action="{{ route('banners.update', $banner['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control" value="{{ $banner["name"] }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Код баннера</label>
                        <textarea class="form-control" name="code" rows="6" required>{{ $banner["code"] }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input type="checkbox"  name="active" class="form-check-input" id="active" {{ $banner->active ? 'checked': '' }}>
                        <label class="form-check-label" for="active">Активен</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Обновить</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
    </div>
</div>
@endsection
