<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{

    public $text;
    public $color;

    public function __construct($color, $text)
    {
        $this->color = $color;
        $this->text = $text;
    }


    public function render()
    {
        return view('components.badge');
    }
}
