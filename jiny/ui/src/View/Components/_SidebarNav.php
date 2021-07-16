<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class SidebarNav extends Component
{

    public function __construct()
    {
    }

    public function render()
    {   
        return view('jinyui::components.sidebar.nav');    
    }
}
