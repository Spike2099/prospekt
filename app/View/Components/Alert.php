<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    public $type;
    public $header;
    public $message;
    public $close;

    public function __construct($type, $message, $header = '', $close = true)
    {
        $this->type = $type;
        $this->header = $header;
        $this->message = $message;
        $this->close = $close;
    }

    public function render()
    {
        return view('components.alert');
    }
}
