<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{

    public $id;
    public $header;
    public $list;


    public function __construct($id, $header, $list = [])
    {
        $this->id = $id;
        $this->header = $header;
        $this->list = $list;
    }


    public function render()
    {
        return view('components.menu');
    }
}
