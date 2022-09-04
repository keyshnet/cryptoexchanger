@extends('admin.layouts.admin')

@section('title', 'Редактировать статическую страницу: ' . $page["name"])

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

        <form action="{{ route('pages.update', $page['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-ru-tab" data-toggle="pill" href="#custom-tabs-three-ru" role="tab" aria-controls="custom-tabs-three-ru" aria-selected="false">Русский</a>
                        </li>
                        @foreach($langs as $l => $lang)
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-{{ $l }}-tab" data-toggle="pill" href="#custom-tabs-three-{{ $l }}" role="tab" aria-controls="custom-tabs-three-{{ $l }}" aria-selected="false">{{ $lang }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade  active show" id="custom-tabs-three-ru" role="tabpanel" aria-labelledby="custom-tabs-three-ru-tab">
                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Название</label>
                                        <input type="text" name="name" class="form-control" value="{{ $page["name"] }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Title страницы</label>
                                        <input type="text" name="title" value="{{ $page["title"] }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Слоган</label>
                                        <input type="text" name="slogan" value="{{ $page["slogan"] }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Текст на странице</label>
                                        <textarea class="form-control" name="content" rows="20">{{ $page["content"] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($langs as $l => $lang)
                        <div class="tab-pane fade" id="custom-tabs-three-{{ $l }}" role="tabpanel" aria-labelledby="custom-tabs-three-{{ $l }}-tab">

                            <x-input-block
                                nameField="Название ({{ $l }})"
                                type="text"
                                name="translate[{{ $l }}][name]"
                                :value="$translates[$l]['name']??''" />

                            <x-input-block
                                nameField="Title страницы ({{ $l }})"
                                type="text"
                                name="translate[{{ $l }}][title]"
                                :value="$translates[$l]['title']??''" />

                            <x-input-block
                                nameField="Слоган ({{ $l }})"
                                type="text"
                                name="translate[{{ $l }}][slogan]"
                                :value="$translates[$l]['slogan']??''" />

                            <x-textarea-block
                                nameField="Текст на странице ({{ $l }})"
                                rows="20"
                                name="translate[{{ $l }}][content]"
                                :text="$translates[$l]['content']??''" />

                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card -->
            </div>


            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Символьный код(адрес страницы)</label>
                        <input type="text" name="code" value="{{ $page["code"] }}" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Шаблон страницы</label>
                        <select class="form-control" name="template">
                            <option value="">Стандартный</option>
                            @foreach(['faq'=>'Faq', 'contacts'=>'Контакты'] as $key=>$templ)
                                <option value="{{ $key }}" @if($key == $page['template']) selected @endif>{{ $templ }}</option>
                            @endforeach
                        </select>
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
