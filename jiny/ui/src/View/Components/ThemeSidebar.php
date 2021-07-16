<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Jiny\UI\View\Components\Icon;

class ThemeSidebar extends Component
{
    public $theme;
    public $data=[];
    public $collapse;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($theme=null)
    {
        if($theme) {
            $this->theme = $theme;
        }        
    }


    public function menuJson($file = "menu/default.json")
    {
        $path = resource_path($file);
        $json = file_get_contents($path);
        $data = json_decode($json,true);

        $this->data = $data;
        return $this;
    }

    
    public function makeNavigation($slot=null)
    {
        //Json Array Parsing
        $tree = $this->tree($this->data);
        
        // 추가 컨덴츠가 있는 경우, 덧부침
        if($slot) {
            $tree->addHtml($slot);
        }

        // menu ul테그 반환
        return $tree->addClass("sidebar-nav");
    }

    
    // 재귀호출 메소드
    private function tree($data = [])
    {
        $menu = CMenu();
        foreach($data as $key => $value) {            
            if(isset($value['header'])) {
                $item = $this->menuHeader($value)->addClass("sidebar-header");
            } else {
                $item = $this->menuItem($value)->addClass("sidebar-item");
            }
            $menu->add($item);
        }

        return $menu;
    }

    public function menuHeader($item)
    {
        return CMenuItem($item['header']);
    }
    
    private function spanTitle($title)
    {
        return CSpan($title)->addClass("align-middle");
    }

    private function itemLink($value)
    {
        $link = CLink()->addClass("sidebar-link");
        if(isset($value['href']) && $value['href']) $link->setUrl($value['href']);
        if(isset($value['target']) && $value['target']) $link->setUrl($value['target']);
        return $link;
    }

    public function menuItem($value)
    {
        //서브메뉴 재귀호출
        if(isset($value['submenu'])) {
            return $this->menuSub($value);
        }
        
        // 아이템       
        $link = $this->itemLink($value);
        if(isset($value['icon']) && $value['icon'] ) {
            $icon = $this->menuIcon($value['icon']); // 아이콘 처리
            $link->addItem($icon);
        }
        if(isset($value['title'])) {
            $link->addItem( $this->spanTitle($value['title']) );
        } else {
            // dd($value);
        }
        

        $item = CMenuItem()->addItem( $link );

        // 선택처리
        if(isset($value['selected']) && $value['selected'] == true) {
            //$item->addClass("selected");
            $item->addClass("active");
        }

        // 메뉴속성 추가
        //$item->set($value);

        return $item;
    }

    public function menuSub($value)
    {
        // collapse id 생성
        $this->collapse = uniqid("collpase_");

        $title = $this->spanTitle($value['title']);
        $link = $this->collpaseLink($title);
        $submenu = $this->collpaseContent($value['submenu']);
        
        return CMenuItem($link)->addItem($submenu); 

    }

    public function collpaseLink($title=null)
    {
        return CLink($title)->addClass("sidebar-link")->addClass("collapsed")
            ->setAttribute("data-bs-toggle","collapse")
            ->setUrl("#".$this->collapse)
            ->setAttribute("role","button")
            ->setAttribute("aria-expanded","false")
            ->setAttribute("aria-controls",$this->collapse);
    }

    public function collpaseContent($item)
    {
        $content = CMenu()
            ->addClass("sidebar-dropdown")->addClass("list-unstyled")->addClass("collapse")
            ->setAttribute("id",$this->collapse);

        foreach ($item as $value) {
            $content->addItem($this->menuItem($value));
        }

        return $content;
    }


    public function menuIcon($icon)
    {
        return (new Icon($icon))->getIcon();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // 기본 resource theme 안에 있는 레이아웃을 읽어옴.
        return view('theme.'.$this->theme.".sidebar");
    }

}
