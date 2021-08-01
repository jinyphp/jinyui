<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class Theme extends Component
{
    public $Theme;
    public $theme_name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($theme=null)
    {
        // 싱글턴 Theme객체
        $this->Theme = \Jiny\UI\Theme::instance();

        if($theme) {
            $this->theme_name = $theme;
            $this->Theme->setTheme($this->theme_name);            
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.theme.theme');
    }
}
