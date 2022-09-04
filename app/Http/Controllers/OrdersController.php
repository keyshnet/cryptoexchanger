<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Mail\OrderCreated;
use App\Models\Orders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function index()
    {
       //
    }

    public function show(Orders $order){

        return view('pages.show-order', [
            'order' => $order
        ]);

    }

    public function update(Request $request, Orders $order)
    {

        $order->status = $request->status;
        $order->save();


        return redirect()->back();
    }

    public function destroy(Orders $order)
    {
        $order->status = "canceled";
        $order->save();
        return redirect()->back();
    }

    public function ajaxCreate(OrderCreateRequest $request)
    {

        $data = $request->all();

        $order = Orders::create([
            'id' => $this->generateUniqueCode(),
            'summ_from' => $data['summ_from'],
            'summ_to' => $data['summ_to'],
            'status' => "temp",
            'currency_from' => $data['currency_from'],
            'currency_to' => $data['currency_to'],
//            'wallet_from' => $data['from_acc'],
            'wallet_to' => $data['wallet_to'],
            'course' => $data['course'],
            'user_id' => Auth::id(),
//            'fio' => $data['from_fio'],
            'email' => $data['email'],
            'country' => json_encode(GeoIP()->getLocation()->toArray()),
        ]);
        if(true){
            $result = [
                'status' => 'ok',
                'msg' => 'Заявка отправлена',
                'order_link' => url('/order/'.$order->id),
            ];
//            Mail::to(env('MAIL_ADMIN'))->send(new OrderCreated($order));
        } else {
            $result = [
                'status' => 'error',
                'msg' => 'Ошибка при создании заявки',
            ];
        }

        return response()->json($result);

    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(1000000, 9999999);
        } while (Orders::where("id", "=", $code)->first());

        return $code;
    }

}
