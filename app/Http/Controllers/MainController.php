<?php

namespace App\Http\Controllers;

use App\Binance\BinanceApi;
use App\Models\Currencie;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;


class MainController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('home');
    }

    public function changeLocale($locale)
    {
        $availableLocales = config('app.asset_local');

        if (!array_key_exists($locale, $availableLocales)) {

            $locale = config('app.locale');
        }

        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
