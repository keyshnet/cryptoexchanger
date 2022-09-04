<?php

namespace App\Http\Controllers;

use App\Models\Currencie;
use App\Models\Page;
use App\Services\Translate\Translate;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class PageController extends Controller
{

    public function index()
    {
        //
    }

    public function showPage($request, Translate $translate)
    {
        $page = Page::where('code', $request)->firstOrFail();
        $page = $translate->getTranslate($page, ['name', 'slogan', 'title', 'content']);

        $blade = 'pages';
        $params = [
            'page' => $page
        ];



        return view($blade, $params);
    }

    public function pageReserve()
    {
        $currencys = Currencie::all();
        return $currencys;
    }
}
