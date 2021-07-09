<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class ScrollBar extends Component
{
    public $scrollwidth=9;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scrollwidth=9)
    {
        $this->scrollwidth = $scrollwidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.scroll-bar');
    }
}
