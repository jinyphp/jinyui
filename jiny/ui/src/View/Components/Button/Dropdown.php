<?php

namespace Jiny\UI\View\Components\Button;

use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('jinyui::components.button.button');
        return <<<'blade'
        {!! xButton($slot)->setAttrs($attributes)->dropdown() !!}
    blade;
    }
}
