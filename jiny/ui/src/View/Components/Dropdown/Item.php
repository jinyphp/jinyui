<?php

namespace Jiny\UI\View\Components\Dropdown;

use Illuminate\View\Component;

class Item extends Component
{
    public function __construct()
    {
    }


    public function render()
    {   
        return <<<'blade'
        <li>
            <a {{ $attributes->merge(['class' => 'dropdown-item']) }}>
                {{ $slot }}
            </a>
        </li>
    blade;  
    }
}
