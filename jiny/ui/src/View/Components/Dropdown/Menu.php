<?php

namespace Jiny\UI\View\Components\Dropdown;

use Illuminate\View\Component;

class Menu extends Component
{
    public $json;
    public function __construct($json=null)
    {
        $this->json =$json;
    }

    public function render()
    {   
        //return view('jinyui::components.dropdown.menu');
        return <<<'blade'
        <ul {{ $attributes->merge(['class' => 'dropdown-menu']) }}>
            @if (isset($json))
                @foreach(json_decode($json) as $item)
                    <x-dropdown-item href="{{$item->href}}">{{$item->title}}</x-dropdown-item>
                @endforeach                        
            @endif
            {{ $slot }}
        </ul>
    blade;  
    }
}
