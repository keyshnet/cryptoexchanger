@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Всего заявок</span>
                    <span class="info-box-number">{{ $ordersCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box  bg-gradient-success col-mb-3">
                <span class="info-box-icon "><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Заявок за сегодня</span>
                    <span class="info-box-number">{{ $ordersCountToday }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box  bg-gradient-danger mb-3">
                <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Не обработанных заявок</span>
                    <span class="info-box-number">{{ $ordersCountNew }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box  bg-gradient-info mb-3">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Зарегистрированных пользователей</span>
                    <span class="info-box-number">{{ $usersCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header border-transparent">
                    <h3>Последние заявки</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
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
                            @foreach($lastOrders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->summ_from }} {{ strtoupper($item->currencyFrom->code) }} </td>
                                    <td>{{ $item->summ_to }} {{ strtoupper($item->currencyTo->code) }} </td>
                                    <td>{{ $item->status }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('orders.show', $item->id) }}">
                                            <i class="fas fa-folder"></i> Посмотреть
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Все заявки</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-6">
            <!-- Donut chart -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3>
                        <i class="far fa-chart-bar"></i>
                        Статистика по странам заявок
                    </h3>
                </div>
                <div class="card-body">
                    <div id="donut-chart" style="height: 300px;"></div>
                </div>
                <!-- /.card-body-->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@section('page-scripts')
    <!-- FLOT CHARTS -->
    <script src="{{asset('/admin/plugins/flot/jquery.flot.js')}}"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{asset('/admin/plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{asset('/admin/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
    <script>
        $(function () {
            var donutData =  @json($orderCoutries, JSON_PRETTY_PRINT);
            $.plot('#donut-chart', donutData, {
                series: {
                    pie: {
                        show       : true,
                        radius     : 1,
                        label      : {
                            show     : true,
                            radius   : 3/4,
                            formatter: labelFormatter
                        }

                    }
                },
                legend: {
                    show: false
                }
            })
        });
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                + label
                + '<br>'
                + Math.round(series.percent) + '%</div>'
        }
    </script>
@endsection

