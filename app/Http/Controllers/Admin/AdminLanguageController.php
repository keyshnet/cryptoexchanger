<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminLanguageController extends Controller
{
    public function index()
    {
        $listLang = config('app.asset_local');
        $langs = [];

        foreach ($listLang as $k=>$lang){
            $langs[$k] = File::get(resource_path("lang//$k.json"));
        }

        return view('admin.language.index', [
            'langs' => $langs
        ]);
    }
}
