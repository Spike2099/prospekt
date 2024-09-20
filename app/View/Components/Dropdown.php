<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{

    public $icon;
    public $link;
    public $href;
    public $target;


    public function __construct($link, $href = '#', $icon = '', $target = '')
    {
        $this->link = $link;
        $this->href = $href;
        $this->icon = $icon;
        $this->target = $target;
    }


    public function render()
    {
        return view('components.dropdown');
    }
}
