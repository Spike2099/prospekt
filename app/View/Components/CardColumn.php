<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardColumn extends Component
{

    public $icon;
    public $header;

    public function __construct($header, $icon = '')
    {
        $this->icon = $icon;
        $this->header = $header;
    }


    public function render()
    {
        return view('components.card-column');
    }
    
}
