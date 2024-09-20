<?php

namespace App\Models;

use App\View\Components\Alert;
use App\View\Components\Card;
use App\View\Components\CardColumn;
use App\View\Components\Button;
use App\View\Components\Dropdown;
use App\View\Components\CategoryCard;
use App\View\Components\Menu;

use Illuminate\Support\Facades\Blade;


class UiComponent
{
    public static function list()
    {
        Blade::component('alert', Alert::class);
        Blade::component('card', Card::class);
        Blade::component('card-column', CardColumn::class);
        Blade::component('button', Button::class);
        Blade::component('dropdown', Dropdown::class);
        Blade::component('category-card', CategoryCard::class);
        Blade::component('menu', Menu::class);
    }
}
