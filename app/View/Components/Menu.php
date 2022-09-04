<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $arrMenu = collect(config('publicMenus'))->map(function ($item){
                if(isset($item['submenu'])) {
                    $parentActive = false;
                    foreach ($item['submenu'] as $k => $subItem){
//                        $item['submenu'][$k]["active"] = (url()->current() == route('pages.show', ['code' => $submenu['route']]));

                        if($item['submenu'][$k]["active"])
                            $parentActive = true;
                    }
                    $item["active"] = $parentActive;
                } else {
                    $item["active"] = (url()->current() == url($item["route"]));
                }
            return $item;
        });

        $this->menu = $arrMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
