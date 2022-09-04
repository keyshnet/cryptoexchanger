<?php

namespace App\View\Components\Forms;

use App\Models\Currencie;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class GetDirection extends Component
{
    public $direction;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $directReq = Exchange::where('code', $request->route()->code)->where('active', true)->first();
        if($directReq)
            $this->direction = $directReq;
        else
            $this->direction = Exchange::where('active', true)->first();


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $currensys = Currencie::with(['listExchangesFrom', 'listExchangesTo'])->get();

        $currFrom = $this->direction->currencyFrom()->first();
        $currFrom->short_name = $currFrom->short_name?: strtoupper($currFrom->code);

        $currTo = $this->direction->currencyTo()->first();
        $currTo->short_name = $currTo->short_name?: strtoupper($currTo->code);


        return view('components.forms.get-direction', [
            'currensys' => $currensys,
            'currency_from_active' => $currFrom,
            'currency_to_active' => $currTo,
            'direction' => $this->direction,
        ]);
    }
}
