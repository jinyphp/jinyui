<?php
/**
 * 
 */
namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class ThemeLayout extends Component
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
        } else {
            $this->theme_name = $this->Theme->getTheme();
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // 기본 resource theme 안에 있는 레이아웃을 읽어옴.
        return view('theme.'.$this->theme_name.".layout");
    }
}
