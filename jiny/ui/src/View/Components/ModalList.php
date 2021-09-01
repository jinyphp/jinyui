<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class ModalList extends Component
{
    public $maxWidth;
    public $zindex;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($maxWidth=null, $zindex = 10)
    {
        $this->maxWidth = $maxWidth;
        $this->z = $zindex;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.modal-list');
    }
}
