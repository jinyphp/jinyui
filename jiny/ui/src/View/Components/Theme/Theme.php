<?php

namespace Jiny\UI\View\Components\Theme;

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
        if (View::exists("theme.".$this->theme_name.'.app')) {
            // 테마 리소스가 있는 경우
            return view("theme.".$this->theme_name.'.app');
        } else {
            
            return view('jinyui::components.theme.theme');
        }

        
    }
}
