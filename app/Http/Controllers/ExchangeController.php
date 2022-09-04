<?php

namespace App\Http\Controllers;

use App\Binance\BinanceApi;
use App\Models\Currencie;
use App\Models\Exchange;
use App\Models\Page;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{


    public function __construct()
    {
        $binance = new BinanceApi();
        $binance->updateCourse();
    }

    public function index()
    {
        //
    }

    public function showDerection()
    {
        $page = Page::where('code', 'exchange')->firstOrFail();

        return view('pages.obmen_direction', [
            'page' => $page
        ]);
    }

    public function ajaxGetDirection(Request $request)
    {

        $currensys = Currencie::with(['listExchangesFrom', 'listExchangesTo'])->get();

        if ($request->ps1 && $request->ps2) {
            $exchange = Exchange::where('currency_from', $request->ps1)->where('currency_to', $request->ps2)->where('active', true)->first();
            if ($exchange) {

                $exchange->course = $exchange->getPrice();
                //                $exchange->url = url('exchange-'.$exchange->code);
                $exchange->title = $exchange->title ?: $exchange->name;

                $currencyFrom = $exchange->currencyFrom()->first();
                $currencyFrom->short_name = $currencyFrom->short_name ?: strtoupper($currencyFrom->code);
                $currencyTo = $exchange->currencyTo()->first();
                $currencyTo->short_name = $currencyTo->short_name ?: strtoupper($currencyTo->code);


                $currencyFrom->image = asset($currencyFrom->image);
                $currencyTo->image = asset($currencyTo->image);
                $result = [
                    'status' => 'ok',
                    'currensys' => $currensys,
                    'currency_from_active' => $currencyFrom,
                    'currency_to_active' => $currencyTo,
                    'direction' => $exchange,
                ];
            } else {
                $currencyFrom = Currencie::where('id', $request->ps1)->first();
                $currencyTo = Currencie::where('id', $request->ps2)->first();
                $currencyFrom->image = asset($currencyFrom->image);
                $currencyTo->image = asset($currencyTo->image);
                $result = [
                    'status' => 'error',
                    'msg' => 'Выбранное направление недоступно',
                    'currency_from_active' => $currencyFrom,
                    'currency_to_active' => $currencyTo
                ];
            }
        } else {
            $result = [
                'status' => 'error',
                'msg' => 'Недопустимо',
                'currency_from_active' => $request->ps1,
                'currency_to_active' => $request->ps2,
                'total' => 0,
            ];
        }
        $result['form'] = view('components.forms.get-direction', $result)->render();

        return response()->json($result);
    }
}
