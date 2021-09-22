<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class ResCreate extends Component
{
    public $nested = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nested=[])
    {
        $this->nested = $nested;
    }

    public function link()
    {
        if (empty($this->nested)) {
            return route(currentRouteName().'.create');
        } else {
            return route(currentRouteName().'.create', $this->nested);
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinytable::components.res-create');
    }
}
