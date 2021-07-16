<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class SidebarLayout extends Component
{

    public function __construct()
    {
    }


    public function render()
    {   
        return view('jinyui::components.sidebar.layout');    
    }
}
