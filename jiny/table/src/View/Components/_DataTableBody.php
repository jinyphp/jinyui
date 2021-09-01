<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class DataTableBody extends Component
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
        return view('jinytable::components.datatablebody');
    }
}
