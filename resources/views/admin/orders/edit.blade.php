@extends('admin.layouts.admin')

@section('title', 'Редактировать заявку: №' . $item["id"])

@section('title_block')
    <a href="{{ route('orders.index') }}" class="btn  btn-dark float-sm-right">назад </a>
@endsection

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
                    <form action="{{ route('orders.update', $item['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                <td>
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="text" name="summ_from" value="{{ $item["summ_from"] }}" class="form-control" required>
                                        </div>
                                        <div class="col-10">
                                            {{ strtoupper($item->currencyFrom->code) }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Сумма получения </td>
                                <td>
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="text" name="summ_to" value="{{ $item["summ_to"] }}" class="form-control" required>
                                        </div>
                                        <div class="col-10">
                                            {{ strtoupper($item->currencyTo->code) }}
                                        </div>
                                    </div>
                                 </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Статус</td>
                                <td>
                                    <select name="status" class="form-control">
                                        @foreach($statuses as $value)
                                            <option value="{{ $value->code }}" {{ ($item->status==$value->code)? 'selected': '' }}>{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">С кошелька</td>
                                <td><input type="text" name="wallet_from" value="{{ $item["wallet_from"] }}" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td class="text-bold">На кошелек</td>
                                <td><input type="text" name="wallet_to" value="{{ $item["wallet_to"] }}" class="form-control" required></td>
                            </tr>

                            <tr>
                                <td class="text-bold">ФИО</td>
                                <td><input type="text" name="fio" value="{{ $item["fio"] }}" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Email</td>
                                <td><input type="text" name="email" value="{{ $item["email"] }}" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td class="project-actions text-right" colspan="2">
                                    <button type="submit" class="btn btn-info">Обновить</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
