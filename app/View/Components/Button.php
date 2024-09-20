<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $size;
    public $type;
    public $text;
    public $color;
    public $icon;
    public $href;

    public function __construct($text, $color = 'primary', $size = '', $type = 'button', $href= '#', $icon = '')
    {
        $this->color = $color;
        $this->text = $text;
        $this->size = $size;
        $this->type = $type;
        $this->href = $href;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.button');
    }
}
