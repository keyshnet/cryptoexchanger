<?php

namespace App\Http\Controllers;

use App\Models\Currencie;
use App\Models\Exchange;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\toArray;

class CurrencieController extends Controller
{
    public $request;

    public function ajaxCalculate(Request $request)
    {
        $val = floatval($request->sum);
        if ($request->ps1 && $request->ps2  && $val) {
            $exchange = Exchange::where('currency_from', $request->ps1)->where('currency_to', $request->ps2)->first();


            if ($exchange) {

                $siteDirect = $request->dej == 1 ? true : false;
                $exchange->course = $exchange->getPrice($siteDirect);


                $exchange->currFrom = $exchange->currencyFrom()->first();
                $exchange->currFrom->short_name = $exchange->currFrom->short_name ?: strtoupper($exchange->currFrom->code);
                $exchange->currTo = $exchange->currencyTo()->first();
                $exchange->currTo->short_name = $exchange->currTo->short_name ?: strtoupper($exchange->currTo->code);

                $total = $val * $exchange->course;

                $resTo = $siteDirect ? $val : $total;

                if ($resTo < $exchange->min) {
                    $result = [
                        'status' => 'error',
                        'status_text' => 'Ошибка',
                        'error_fields' => ["sum1" => 'min.: <span class="js_amount" data-id="sum1">' . $exchange->min . '</span> ' . $exchange->currFrom->code],
                        'msg' => __('Ниже минимума'),
                        'curs_html' => '1 ' . $exchange->currFrom->code . ' = ' . $exchange->getPrice() . ' ' . $exchange->currTo->code,
                        'total' => $total,
                        'sum1' => $val,
                        'sum2' => $total,
                        'reserv_html' => $exchange->currTo->reserve
                    ];
                } elseif ($resTo > $exchange->max) {
                    $result = [
                        'status' => 'error',
                        'status_text' => 'Ошибка',
                        'error_fields' => ["sum1" => 'max.: <span class="js_amount" data-id="sum1">' . $exchange->max . '</span> ' . $exchange->currFrom->code],
                        'msg' => __('Выше максимума'),
                        'curs_html' => '1 ' . $exchange->currFrom->code . ' = ' . $exchange->getPrice() . ' ' . $exchange->currTo->code,
                        'total' => $total,
                        'sum1' => $val,
                        'sum2' => $total,
                        'reserv_html' => $exchange->currTo->reserve
                    ];
                } else {
                    $result = [
                        'status' => 'ok',
                        'direction' => $exchange,
                        'curs_html' => '1 ' . $exchange->currFrom->code . ' = ' . $exchange->getPrice() . ' ' . $exchange->currTo->code,
                        'total' => $total,
                        'sum1' => $val,
                        'sum2' => $total,
                        'reserv_html' => $exchange->currTo->reserve
                    ];
                }
            } else {
                $result = [
                    'status' => 'error',
                    'msg' => __('Выбранное направление недоступно'),
                ];
            }
        } else {
            $result = [
                'status' => 'error',
                'status_text' => 'Ошибка',
                'error_fields' => ["sum1" => __('Недопустимо')],
                'total' => 0,
            ];
        }
        return json_encode($result);
    }

    public function ajaxGetCurrencyTo(Request $request)
    {
    }
}
