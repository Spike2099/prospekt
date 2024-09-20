<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardItem extends Component
{

    public $id;
    public $image;
    public $brand;
    public $articul;
    public $name;
    public $vector;
    public $percent;
    public $price;
    public $count;
    public $ratio;



    public function __construct($id, $image = '', $brand, $articul, $name, $vector, $percent, $price = 0, $count = 1, $ratio = 0)
    {
        $this->id = $id;
        $this->image = $image;
        $this->brand = $brand;
        $this->articul = $articul;
        $this->name = $name;
        $this->vector = $vector;
        $this->percent = $percent;
        $this->price = $price;
        $this->count = $count;
        $this->ratio = $ratio;
    }


    public function render()
    {
        return view('components.card-item');
    }
}
