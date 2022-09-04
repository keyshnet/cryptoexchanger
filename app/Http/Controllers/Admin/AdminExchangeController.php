<?php

namespace App\Http\Controllers\Admin;

use App\Binance\BinanceApi;
use App\Http\Controllers\Controller;
use App\Models\Currencie;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Helpers;
use function PHPUnit\Framework\returnSelf;

class AdminExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

//        $this->autoCreate();
//        $this->autoUpdateDirections();
        $items = Exchange::all();
        return view('admin.exchanges.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $binance = new BinanceApi();
        $exchange['binance_courses'] = $binance->getAllCourse();

        $exchange['currencies'] = Currencie::all();
        return view('admin.exchanges.add', [
            'item' => $exchange
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newPage = Exchange::create([
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'title' => $data['title'],
            'code' => $data['code'],
            'currency_from' => $data['currency_from'],
            'currency_to' => $data['currency_to'],
            'min' => $data['min'],
            'max' => $data['max'],
            'active' => $data['active'],
            'course' => $data['course'],
            'auto_add_to_price' => $data['auto_add_to_price']
        ]);

        return redirect()->back()->withSuccess('Страница успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exchange $exchange
     * @return \Illuminate\Http\Response
     */
    public function show(Exchange $exchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Exchang $exchange
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Exchange $exchange)
    {
        $binance = new BinanceApi();
        $exchange['binance_courses'] = $binance->getAllCourse();

        $exchange['currencies'] = Currencie::all();
        return view('admin.exchanges.edit', [
            'item' => $exchange
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exchange $exchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exchange $exchange)
    {

        $data = $request->all();

        $exchange->name = $request->name;
        $exchange->title = $request->title;
        $exchange->code = $request->code;
        $exchange->currency_from = $request->currency_from;
        $exchange->currency_to = $request->currency_to;
        $exchange->min = $request->min;
        $exchange->max = $request->max;
        $exchange->course = $request->course;
        $exchange->course_code = $request->course_code;
        $exchange->auto_course_act = $request->has('auto_course_act');
        $exchange->auto_course_market = $request->auto_course_market;
        $exchange->auto_course_direct = $request->has('auto_course_direct');
        $exchange->auto_add_to_price = $request->auto_add_to_price;
        $exchange->active = $request->has('active');
        $exchange->save();


        return redirect()->back()->withSuccess('Страница успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Exchange $exchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exchange $exchange)
    {
        $exchange->delete();
        return redirect()->back()->withSuccess('Страница "' . $exchange["name"] . '" успешно удалена!');
    }


    public function updateCourse(Request $request, Exchange $exchange)
    {

        dd($request);

        $request->all();

        $exchange->name = $request->name;
        $exchange->title = $request->title;
        $exchange->currency_from = $request->currency_from;
        $exchange->currency_to = $request->currency_to;
        $exchange->min = $request->min;
        $exchange->max = $request->max;
        $exchange->course = 0;
        $exchange->save();


        return redirect()->back()->withSuccess('Страница успешно изменена!');
    }

    public function autoCreate()
    {
        $num = 0;
        $currensis = Currencie::all();
        $createExchange = [];

        foreach ($currensis as $k => $cur) {
//            dump($k);
            $curRev = $currensis->where('id', '!=', $cur->id);
//            dump($cur->listExchangesFrom);
//            echo $cur->name . ' ----------- <br>';
            foreach ($curRev as $cRev) {
//                dump($cur->code, $cRev->code);
//                dd($this->findCourseCodeBinance($cur->code, $cRev->code));
//                echo '------ ' . $cRev->name .'<br>';
                $exchage = Exchange::where([
                    ['currency_from', '=', $cur->id],
                    ['currency_to', '=', $cRev->id]
                ])->get();
                $num++;
                if (count($exchage) <= 0) {

                    $createExchange = [
                        'name' => strtoupper($cur->code . '-' . $cRev->code),
                        'code' => strtoupper($cur->code . $cRev->code),
                        'currency_from' => $cur->id,
                        'currency_to' => $cRev->id,
                        'min' => 1,
                        'max' => 1000,
                        'course' => 1
                    ];
                    if($auto_code_course = $this->findCourseCodeBinance($cur->code, $cRev->code)){
                        $createExchange['course_code'] = $auto_code_course['course_code'];
                        $createExchange['auto_course_direct'] = $auto_code_course['auto_course_direct'];
                        $createExchange['auto_course_act'] = 1;
//                        $createExchange['course'] = $auto_code_course['course'];
                    }
//                    dump($createExchange);

                  Exchange::create($createExchange);
                }

            }

        }
//        dd(count($createExchange));
    }

    public function autoUpdateDirections()
    {
        $num = 0;
//        $currensis = Currencie::all();
        $directions = Exchange::all();

        foreach ($directions as $direction){
//            $direction->code = strtolower(''.$direction->currencyFrom->code.'-to-'.$direction->currencyTo->code);
            $direction->auto_add_to_price = ($direction->auto_course_direct == 1)? -2:2;
            $direction->save();
        }
    }

    public function findCourseCodeBinance($cur1, $cur2)
    {
        $binance = new BinanceApi();
        $binanceCourses = $binance->getAllCourse();

        $course_code = collect($binanceCourses)->where('symbol', '=', strtoupper($cur1.$cur2))->first();
        if($course_code){
            $res['course_code'] = $course_code->symbol;
            $res['auto_course_direct'] = 1;
            $res['course'] = $course_code->price;
        } else {
            $course_code = collect($binanceCourses)->where('symbol', '=', strtoupper($cur2.$cur1))->first();
            if($course_code){
                $res['course_code'] = $course_code->symbol;
                $res['auto_course_direct'] = 0;
                $res['course'] = $course_code->price;
            } else {
                return false;
            }
        }


        return $res;
    }


}
