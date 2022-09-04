<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\Translate\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.add');
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

        $newPage = Page::create([
            'name' => $data['name'],
            'title' => $data['title'],
            'code' => $data['code'],
            'slogan' => $data['slogan'],
            'content' => $data['content'],
        ]);

        return redirect()->back()->withSuccess('Страница успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Page $page, Translate $translate)
    {

        $langs = config('app.asset_local');
        unset($langs['ru']);

        foreach ($langs as $l => $lang) {
            $translates[$l] = $translate->getTranslateArray($page, ['name', 'slogan', 'title', 'content'], $l);
        }

        return view('admin.pages.edit', [
            'page' => $page,
            'langs' => $langs,
            'translates' => $translates
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page, Translate $translate)
    {
        $data = $request->all();

        $translate->setTranslate($page, $data['translate']);

        $page->name = $request->name;
        $page->title = $request->title;
        $page->code = $request->code;
        $page->slogan = $request->slogan;
        $page->content = $request->content;
        $page->template = $request->template;
        $page->save();


        return redirect()->back()->withSuccess('Страница успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->withSuccess('Страница "' .$page["name"]. '" успешно удалена!');
    }
}
