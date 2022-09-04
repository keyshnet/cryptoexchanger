<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use App\Models\Orders;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\toArray;

class HomeController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $ordersCount = Orders::all()->count();
        $ordersCountNew = Orders::where('status',  'new')->count();
        $ordersCountToday = Orders::where('created_at',  today())->count();
        $usersCount = User::all()->count();
        $lastOrders = Orders::orderBy('created_at', 'desc')->take(5)->get();
        $orderCoutries = Orders::pluck('country');

        $orderCoutriesCount = $orderCoutries->map(function ($item) {
            if(empty(json_decode($item)->country))
                return 'Unknown';
            else
                return json_decode($item)->country;
        })->countBy();

        $orderCoutriesData = [];
        foreach ($orderCoutriesCount as $country => $count) {
            $orderCoutriesData[] = [
                'label' => $country,
                'data' => $count / $ordersCount * 100
            ];
        };

        return view('admin.index', [
            'ordersCount' => $ordersCount,
            'ordersCountNew' => $ordersCountNew,
            'ordersCountToday' => $ordersCountToday,
            'usersCount' => $usersCount,
            'lastOrders' => $lastOrders,
            'orderCoutries' => $orderCoutriesData
        ]);
    }
}
