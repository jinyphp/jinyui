<?php
/**
 * 테마, 사이드바 디자인 설정 컴포넌트
 * 메뉴코드 생성 함수포함
 */
namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;


class ThemeSidebar extends Component
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
        if (View::exists("theme.".$this->theme_name.'.sidebar')) {
            // 테마 리소스가 있는 경우          
            $res = view("theme.".$this->theme_name.'.sidebar');
            return $res;

        } else {
            // 컴포넌트 리소스로 대체하여 출력함
            return view('jinyui::components.sidebar.layout');
        }

    }

}
