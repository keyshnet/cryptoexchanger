<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currencie;
use Illuminate\Http\Request;

class AdminCurrencieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Currencie::all();
        return view('admin.currency.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->file('image')) {
            $pathImage = $request->file('image')->store('uploads', 'public');
            $data["image"] = '/storage/'.$pathImage;
        }

        $newPage = Currencie::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'image' => $data['image'],
            'reserve' => $data['reserve'],
            'type' => $data['type'],
            'example' => $data['example'],
            'wallet_get' => $data['wallet_get'],
            'memo_act' => $request->has('memo_act'),
            'memo' => $data['memo'],
//            'network' => json_encode($data['network']),
        ]);

        return redirect()->back()->withSuccess('Страница успешно добавлена!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currencie  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currencie $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currencie  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currencie $currency)
    {
        $currency["network"] = json_decode($currency["network"]);

        return view('admin.currency.edit', [
            'item' => $currency
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currencie  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currencie $currency)
    {
        $data = $request->all();
        if($request->file('image')) {
            $pathImage = $request->file('image')->store('uploads', 'public');
            $currency->image = '/storage/'.$pathImage;
        }

        $currency->name = $request->name;
        $currency->short_name = $request->short_name;
        $currency->code = $request->code;
        $currency->reserve = $request->reserve;
        $currency->type = $request->type;
        $currency->network = json_encode($request->network);
        $currency->example = $request->example;
        $currency->wallet_get = $request->wallet_get;
        $currency->memo_act = $request->has('memo_act');
        $currency->memo = $request->memo;
        $currency->save();


        return redirect()->back()->withSuccess('Страница успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currencie  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currencie $currency)
    {
        $currency->delete();
        return redirect()->back()->withSuccess('Страница "' .$currency["name"]. '" успешно удалена!');
    }
}
