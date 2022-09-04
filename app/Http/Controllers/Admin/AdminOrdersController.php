<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currencie;
use App\Models\Exchange;
use App\Models\Orders;
use App\Models\Status;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\toArray;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $statuses = Status::all();


        $status = 'temp';

        if ($request->status)
            $status = $request->status;

        if ($request->status == "all")
            $items = Orders::orderBy('id', 'desc')->get();
        else
            $items = Orders::orderBy('id', 'desc')->where('status', $status)->get();



        return view('admin.orders.index', [
            'items' => $items,
            'statuses' => $statuses,
            'route_status' => $request->status?: 'temp'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Orders::find($id);

        return view('admin.orders.show', [
            'item' => $item
        ]);
    }

    /**
     * @param Orders $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Orders $order)
    {

        $statuses = Status::all();
        return view('admin.orders.edit', [
            'item' => $order,
            'statuses' => $statuses
        ]);
    }

    /**
     * @param Request $request
     * @param Orders $order
     * @return mixed
     */
    public function update(Request $request, Orders $order)
    {

        $order->summ_from = $request->summ_from;
        $order->summ_to = $request->summ_to;
        $order->wallet_from = $request->wallet_from;
        $order->wallet_to = $request->wallet_to;
        $order->fio = $request->fio;
        $order->email = $request->email;
        $order->status = $request->status;
        $order->save();


        return redirect()->back()->withSuccess('Заявка успешно изменена!');
    }

    /**
     * @param Orders $order
     * @return mixed
     */
    public function destroy(Orders $order)
    {
        $order->delete();
        return redirect()->back()->withSuccess('Заявка "' .$order["name"]. '" успешно удалена!');
    }
}
