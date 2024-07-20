<?php

namespace App\View\Components\Frontend\Components;

use Illuminate\View\Component;

class NavBar extends Component
{
    public $menus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('frontend.components.nav-bar');
    }
}
