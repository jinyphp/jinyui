<?php

namespace Jiny\UI\View\Components\Dropdown;

use Illuminate\View\Component;

class Dropdown extends Component
{

    public function __construct()
    {
    }


    public function render()
    {   
        return <<<'blade'
        <div {{ $attributes->merge(['class' => 'dropdown']) }}>
            {{ $slot }}
        </div>
    blade;  
    }
}
