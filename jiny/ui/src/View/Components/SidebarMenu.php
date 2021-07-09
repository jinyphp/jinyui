<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public $data=[];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $path = resource_path("menu/default.json");
        $json = file_get_contents($path);
        $data = json_decode($json,true);

        $this->data = $data;
        
        /*
        $this->data = [
            ['title'=>"menu1"],
            [
                'title'=>"menu2",
                'submenu' => [
                    ['title'=>"menu 2-1"],
                    ['title'=>"menu 2-2"]
                ]
            ],
            "메뉴2",
            ['title'=>"menu3"]
        ];
        */
    }

    public function menu()
    {
        return $this->data;
    }


    public function makeTree($slot=null)
    {
        $tree = $this->tree($this->data);
        if($slot) {
            $tree->addHtml($slot);
        }
        return $tree->addClass("sidemenu");
    }

    // 재귀호출 메소드
    private function tree($data = [])
    {
        $menu = CMenu();
        foreach($data as $key => $value) {            
            if(isset($value['header'])) {
                $item = $this->menuHeader($value);
            } else {
                $item = $this->menuItem($value)->addClass("sidebar-item");
            }
            $menu->add($item);
        }
        return $menu;
    }


    public function menuHeader($item)
    {
        return CMenuItem($item['header'])->addClass("sidebar-header");
    }


    public function menuItem($value)
    {
        //서브메뉴 재귀호출
        if(isset($value['submenu'])) {
            return $this->menuSub($value)->addClass("submenu") ;
        }

        
        $item = CMenuItem();
        // 아이콘 처리
        if(isset($value['icon']) && $value['icon'] ) {
            $item->addItem( $this->menuIcon($value['icon']) );
        }

        // 링크연결
        $link = CLink($value['title']);
        if(isset($value['href']) && $value['href']) $link->setUrl($value['href']);
        if(isset($value['target']) && $value['target']) $link->setUrl($value['target']);
        $item->addItem( $link->addClass("sidebar-link") );

        // 선택처리
        if(isset($value['selected']) && $value['selected'] == true) {
            $item->addClass("selected");
        }

        // 메뉴속성 추가
        $item->set($value);

        return $item;
    }

    public function menuIcon($icon)
    {
        $path = resource_path("icon/svg/".$icon.".svg");
        $file = file_get_contents($path);
        return CSpan()->addHtml($file)->addClass("icon");
    }

    public function menuSub($value)
    {
        $content = CDiv()
                ->setAttribute("@click","open = ! open"); //AlpinJS

        return CMenuItem()
            ->addItem($content->addItem($value['title']))
            ->addItem(
                $this->tree($value['submenu'])->setAttribute("x-show","open") //AlpinJS
            )
            ->setAttribute( "x-data", "{ open: false }"); //AlpinJS
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.sidebar-menu');
    }
}
