<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    public $icon;
    public $header;
    public $verified;

    public function __construct($header, $verified = '', $icon = '')
    {
        $this->icon = $icon;
        $this->header = $header;
        $this->verified = $verified;
    }

    public function render()
    {
        return view('components.card');
    }

}