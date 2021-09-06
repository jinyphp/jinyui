<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;


class XGroup extends CTag
{

    private $type;
    
    public function __construct($items = []) {
		parent::__construct('div', true);

        foreach($items as $item) {
            $this->addItem($item);
        }		
	}
    


    /**
     * 복수의 아이템을 설정합니다.
     *
     * @param  mixed $items
     * @return void
     */
    public function setItems($items=[])
    {
        foreach($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }
    
    /**
     * 테그이름을 변경합니다.
     *
     * @param  mixed $name
     * @return void
     */
    public function setTagName($name)
    {
        $this->tagname = $name;
        return $this;
    }

    public function setButton($dir=null)
    {
        if ($dir == "vertical") {
            $this->addClass("btn-group-vertical"); // 부트스트랩 클래스
        } else {
            $this->addClass("btn-group"); // 부트스트랩 클래스
        }        
        $this->role("group");
        return $this;
    }

    public function setButtonSize($size)
    {
        if ($size == "large") {
            $this->addClass("btn-group-lg");
        } else if ($size == "small") {
            $this->addClass("btn-group-sm");
        }
        

        return $this;
    }

    // 그룹 리스트 객체를 반환합니다.
    public function list()
    {
        $list = xList(); // 리스트 인스턴스
        $list->group = $this;
        $list->items = $this->items; // 그룹안에 있는 아이템을 리스트로 넘김.
        if($this->items[0]->tagname == "a") {
            $list->list->tagname = "div";
        }
        //dd($list);
        return $list;
    }


    /*
    public function setTypeList()
    {
        $this->type = "list";
        $this->addClass("list-group");
        return $this;
    }

    public function setStyleFlush()
    {
        $this->addClass("list-group-flush");
        return $this;
    }




    */


    public function toString($destroy = true) {
        /*
        if ($this->type == "list") {
            // 등록된 아이템이 li인 경우 그룹테그를 div -> ul로 변경
            if($this->items[0]->tagname == "li") {
                $this->tagname = "ul";
            }

            foreach($this->items as &$item) {
                if(!$item->isClass("list-group-item")) {
                    $item->addClass("list-group-item");
                }
            }

            if ($this->active) {
                $this->items[ $this->active -1 ]->addClass("active"); 
            }
        }
        */

        return parent::toString($destroy);
    }

    public function setAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {           
            foreach($attrs as $name => $value) {
                if ($name === "class") {
                    $this->addClass($value);
                    continue;
                }
                $this->setAttribute($name, $value);
            }
        }
        return $this;
    }


}