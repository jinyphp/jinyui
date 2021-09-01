<?php

namespace Jiny\UI\View\Components\Dropdown;

use Illuminate\View\Component;

class Link extends Component
{
    public function __construct()
    {
    }


    public function render()
    {   
        // 링크옆 화살표 표시 :
        return <<<'blade'
        <a {{ $attributes->merge(['class' => 'dropdown-toggle']) }} role="button" data-bs-toggle="dropdown" aria-expanded="false" >
            {{ $slot }}
        </a>
    blade;  
    }
    
}
