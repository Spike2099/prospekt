<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryCard extends Component
{

    public $icon;
    public $header;
    public $category;

    public function __construct($header, $category, $icon = '')
    {
        $this->icon = $icon;
        $this->header = $header;
        $this->category = $category;
    }


    public function render()
    {
        return view('components.category-card');
    }
}
