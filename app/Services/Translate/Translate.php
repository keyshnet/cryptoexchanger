<?php

namespace App\Services\Translate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Translate {

    protected $lang;

    public function __construct()
    {
        $this->lang = App::getLocale();
//        dd($this->lang);
    }

    public function getTranslate(Model $obj, $fields = [], $lang = null)
    {
        $lang = $lang?? $this->lang;

        foreach ($fields as $key => $field){
            $newValue = DB::table('languages')->where([
                ['model', '=', $obj->getTable()],
                ['field', '=', $field],
                ['page_id', '=', $obj->id],
                ['lang', '=', $lang],
            ])->first();
            if($newValue && $newValue->value !== null)
                $obj->$field = $newValue->value;
        };
        return $obj;
    }

    public function getTranslateArray(Model $obj, $fields = [], $lang = null)
    {
        $lang = $lang?? $this->lang;

        $result = [];
        foreach ($fields as $key => $field){
            $newValue = DB::table('languages')->where([
                ['model', '=', $obj->getTable()],
                ['field', '=', $field],
                ['page_id', '=', $obj->id],
                ['lang', '=', $lang],
            ])->first();
            if($newValue && $newValue->value !== null)
                $result[$field] = $newValue->value;
        };
        return $result;
    }

    /**
     * @param string $lang
     */
    public function setTranslate($page, $translate)
    {
        foreach($translate as $l => $lang){
            foreach ($lang as $field => $value) {
                if ($value) {
                    $insertArr = [
                        'model' => $page->getTable(),
                        'field' => $field,
                        'page_id' => $page->id,
                        'lang' => $l,
                    ];
                    DB::table('languages')->updateOrInsert($insertArr, ['value' => $value]);
                } else {
                    DB::table('languages')->where([
                        ['model', '=', $page->getTable()],
                        ['field', '=', $field],
                        ['page_id', '=', $page->id],
                        ['lang', '=', $l],
                    ])->delete();
                }
            }
        }
    }
}
