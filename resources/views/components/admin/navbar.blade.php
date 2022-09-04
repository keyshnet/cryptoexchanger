<ul class="navbar-nav ">
    <li class="d-none d-sm-inline-block"><span class="nav-link text-blue lead text-bold">Заявок всего: <span class="badge bg-success ">{{ $ordersCount }}</span></span></li>
    <li class=" d-none d-sm-inline-block"><span class="nav-link text-blue lead text-bold">Заявок сегодня: <span class="badge bg-success">{{ $ordersCountToday }}</span></span></li>
    <li class=" "><span class="nav-link text-blue lead text-bold">Необработанных заявок: <span class="badge bg-danger">{{ $ordersCountNew }}</span></span></li>
</ul>
<ul class="navbar-nav ml-auto  d-none d-sm-inline-block">
    <li><span class="nav-link text-blue lead text-bold">Зарегистрированных пользователей: <span class="badge bg-primary">{{ $usersCount }}</span></span></li>
</ul>
