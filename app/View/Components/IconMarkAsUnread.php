<?php

namespace App\View\Components;

use App\View\Components\Icon;

class IconMarkAsUnread extends Icon
{
    public function render()
    {
        return view('components.icon-mark-as-unread');
    }
}
