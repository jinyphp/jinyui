<?php 
namespace Jiny\UI\Components;

use Jiny\Html\CTag;

class XBreadCrumb
{
    /**
     * 싱글턴
     */
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {             
            self::$Instance = new self();
            self::$Instance->obj = new CTag('ol', true);
        } 
        return self::$Instance; 
    }

    public $obj;

    private function init()
    {
        $this->obj = new CTag('ol', true); //초기화
    }

    public function addLink($title, $href=null)
    {
        
        if ($href) {
            $link = xLink($title, $href);
            $li = new CTag('li', true,$link);
        } else {
            $li = new CTag('li', true, $title);
        }

        $this->obj->addItem($li);
        return $this;
    }

    public function setLinks($arr)
    {
        foreach($arr as $item) {
            $this->addLink($item['title'], $item['href']);
        }
        return $this;
    }

    public $slot;
    public function addHtml($slot)
    {
        $this->slot = $slot;
        return $this;
    }

    public function show()
    {
        if (!empty($this->obj->items)) {
            foreach($this->obj->items as &$item) {
                $item->addClass("breadcrumb-item");
            }
    
            $item->addClass("active"); // 마지막 항목에 active 추가
        }
        
        $res = $this->obj->addClass("breadcrumb");
        $this->obj->addHtml($this->slot);

        $this->init();
        return $res;
    }


    public function __toString()
    {
        $res = "";
        return $res;
	}


}