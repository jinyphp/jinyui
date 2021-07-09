<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class SidebarItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.sidebar-item');
        /*
        $res = <<<'blade'
        <div>
        {!! CMenuItem()
            ->addItem( CLink($slot)->addClass("sidebar-link") )
            ->setLivewireAttrs($attributes)
            ->addClass("sidebar-item") !!} 
        </div>
        blade;
		
		return $res;
        */
    }
}
