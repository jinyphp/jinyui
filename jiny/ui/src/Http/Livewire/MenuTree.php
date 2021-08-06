<?php

namespace Jiny\UI\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\View;
use Jiny\UI\View\Components\Icon;

class MenuTree extends Component
{
    public $menu; //json-menu-data
    public $content, $before, $after;
    public $admin = true;

    public $filename;
    public $json;

    public function mount()
    {
        /*
        $this->json = new \Jiny\UI\Json();
        $this->json->setFilename($this->filename);
        $this->json->set($this->menu);
        */
    }


    public function setData($data)
    {
        $this->menu = $data;
        return $this;
    }


    public function build($slot=null)
    {
        //Json Array Parsing
        $tree = $this->tree($this->menu);
        
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


    // 메뉴 타이틀
    public function menuHeader($value)
    {
        //return CMenuItem($item['header']);
        $item = CMenuItem();
        $item->addItem($value['header']);
        
        /*
        if($this->admin) {
            $item->addItem( 
                $this->menuIcon("feather-settings")
                    ->setWidth("w-2")->setHeight("h-2")
                    ->getIcon()
            );
        }
        */
        
        return $item;
    }


    // 메뉴 아이콘
    public function menuItem($value)
    {
        //서브메뉴 재귀호출
        if(isset($value['submenu'])) {
            return $this->menuSub($value);
        }
        
        // 아이템       
        $link = $this->itemLink($value);
        if(isset($value['icon']) && $value['icon'] ) {
            $icon = $this->menuIcon($value['icon']);
            $link->addItem($icon);
        }
        if(isset($value['title'])) {
            $link->addItem( $this->spanTitle($value['title']) );
        } else {
        }
        

        $item = CMenuItem()->addItem( $link );

        // 선택처리
        if(isset($value['selected']) && $value['selected'] == true) {
            //$item->addClass("selected");
            $item->addClass("active");
        }

        // 메뉴속성 추가
        //$item->set($value);
        
        // 관리자모드
        /*
        if($this->admin) {
            $dots = $this->menuIcon()->featherDotsVertical()->addClass("text-white w-4 h-4");
            $item->addItem( 
                CLink($dots)->setAttribute('wire:click',"edit(".$value['_id'].")")
            )->addClass("flex flex-row justify-between align-middle");
        }
        */
        
        return $item;
    }


    public function menuSub($value)
    {
        // collapse id 생성
        $this->collapse = uniqid("collpase_");

        $link = $this->collpaseLink();
        if(isset($value['icon']) && $value['icon'] ) {
            $icon = $this->menuIcon($value['icon']);//->getIcon(); // 아이콘 처리
            $link->addItem($icon);
        }
        $link->addItem( $this->spanTitle($value['title']) );

        /*
        if($this->admin) {
            // $link = CDiv([
            //     $link,
            //     CLink(
            //         CSpan("+")->addClass("align-middle")
            //     )->addClass("sidebar-link") 
            // ])->addClass("flex flex-row justify-between");
        }
        */
        
        $submenu = $this->collpaseContent($value['submenu']);
        
        return CMenuItem($link)->addItem($submenu);
    }




    // 메뉴 링크
    private function itemLink($value)
    {
        $link = CLink()->addClass("sidebar-link");
        if(isset($value['href']) && $value['href']) $link->setUrl($value['href']);
        if(isset($value['target']) && $value['target']) $link->setUrl($value['target']);
        
        return $link;
    }

    private function spanTitle($title)
    {
        return CSpan($title)->addClass("align-middle");
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


    public function menuIcon($icon=null)
    {

        return (new Icon($icon));//>setFile($icon);
    }


    public function render()
    {
        return view('jinyui::livewire.menu-tree',['tree'=>$this->build($this->content)]);
    }












    /**
     * 
     */

    public function sort()
    {
        
    }

    // modal popup

    public $modalEditMenuAdmin = false;
    public $_data;
    public function edit($id)
    {
        $this->modalEditMenuAdmin = true;
        $this->_data = $this->findId($id, $this->menu);
        
    }

    public function update()
    {
        $this->modalEditMenuAdmin = false;
    }

    public function findId($id, $menu)
    {
        foreach($menu as $value) {
            if($id == $value['id']) return $value;
            if(isset($value['submenu'])) {
                $item = $this->findId($id, $value['submenu']);
                if(isset($item['id']) && $item['id'] == $id) return $item;
            }
        }
    }




}
