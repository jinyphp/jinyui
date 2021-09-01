<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class SidebarSubmenu extends Component
{
    public $collapse;


    public function __construct()
    {
        $this->collapse = uniqid("collpase_");


    }

    public function menuLink($title=null)
    {
        return CLink($title)->addClass("sidebar-link")->addClass("collapsed")
            ->setAttribute("data-bs-toggle","collapse")
            ->setUrl("#".$this->collapse)
            ->setAttribute("role","button")
            ->setAttribute("aria-expanded","false")
            ->setAttribute("aria-controls",$this->collapse);
    }

    public function menuContent($content)
    {
        return CMenu()
            ->addClass("sidebar-dropdown")->addClass("list-unstyled")->addClass("collapse")
            ->setAttribute("id",$this->collapse)
            ->addItem($content);
    }


    public function render()
    {   
        return view('jinyui::components.sidebar.submenu');    
    }
}
