<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class DropdownMenu extends Component
{
    public $json;
    public $title;

    public function __construct($json=null)
    {
        $this->json =$json;
    }



    public function render()
    {   
        return view('jinyui::components.dropdown.menu');
        return <<<'blade'
        <ul {{ $attributes->merge(['class' => 'dropdown-menu']) }}>
            {{ $slot }}
        </ul>
    blade;  
    }
}
