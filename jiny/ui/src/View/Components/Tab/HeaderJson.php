<?php

namespace Jiny\UI\View\Components\Tab;

use Illuminate\View\Component;

class HeaderJson extends Component
{
    public $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active=null)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.tab.header-json');
    }
}
