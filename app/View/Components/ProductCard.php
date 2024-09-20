<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Providers\getImageMsProvider;


class ProductCard extends Component
{
	
    public $id;
    public $name;
    public $image; // = '/img/no_photo.jpg'
    public $href;
    public $vendorcode;
    public $price;
    public $availability = 0;
    public $modifications;
    public $category;


    public function __construct($id, $name, $image, $href, $vendorcode, $price, $availability, $modifications, $category)
    {
        $this->id          = $id;
        $this->name          = $name;
        $this->image         = $image;
        $this->href          = $href;
        $this->vendorcode    = $vendorcode;
        $this->price         = $price;
        $this->availability  = $availability;
        $this->modifications = $modifications;
        $this->category = $category;
    }


    public function render()
    {
        //, ['img' => new getImageMsProvider()]
        return view('components.product-card');
    }
}
