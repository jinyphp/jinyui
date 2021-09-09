<?php
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XList 
{
	
	private static $Instance;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance($attrs=[])
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();
			self::$Instance->list = new \Jiny\Html\CTag("ul", true);
        } 

		if (!empty($attrs)) {
			self::$Instance->attributes = $attrs;
		}

		return self::$Instance; 
    }



	public $list;
	public $attributes;
	public $items=[];
	public $group;
	private $active;
	public function addItem($item, $attrs=[])
	{
		$li = xListItem($item);
		$this->items []= $this->setAttrs($li, $attrs);
	}

	private function setAttrs($item, $attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "href") {
                    $item->setUrl($value);
                    continue;
                } else if ($name === "class") {
                    $item->addClass($value);
                    continue;
                }
                $item->setAttribute($name, $value);
            }
        }
        return $item;
    }


	public function addClass($class)
	{
		$this->list->addClass($class);
		return $this;
	}

	public function setActive($num)
    {
        $this->active = $num;
        return $this;
    }

	public function setBootstrap()
	{
		// 부트스트랩 리스트그룹 클래스 적용
		if(!$this->list->isClass("list-group")) {
			$this->list->addClass("list-group");
		}

		foreach ($this->list->items as &$item) {
			if(!$item->isClass("list-group-item")) {
				$item->addClass("list-group-item");
			}
		}

		if ($this->active) {
			$this->list->items[ $this->active -1 ]->addClass("active"); 
		}

		return $this;
	}

	public function tabEnable()
	{
		/*
		<a class="list-group-item list-group-item-action active" role="tab" aria-selected="false" data-bs-toggle="list" href="#account">Account</a>
		*/
		foreach ($this->items as &$item) {
			$item->addClass("list-group-item-action")
            ->setAttribute("role","tab")
            ->setAttribute("aria-selected","false");
			$item->setAttribute("data-bs-toggle", "list");
		}
		return $this;
	}

	public function __toString() 
	{
		// 객체추가
		foreach ($this->items as $item) {
			$this->list->addItem($item);
		}

		self::$Instance = null; // 초기화
		$this->list = $this->setAttrs($this->list, $this->attributes); //시만틱 속성적용


		$this->setBootstrap();


		return $this->list->toString();
	}




}