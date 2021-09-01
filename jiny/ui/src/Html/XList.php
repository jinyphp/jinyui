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
	public function addItem($item, $attrs=[])
	{
		$li = xListItem($item);
		$this->items []= $this->setAttrs($li, $attrs);
	}

	public function addClass($class)
	{
		$this->list->addClass($class);
		return $this;
	}

	
	public function __toString() 
	{
		foreach ($this->items as $item) {
			$this->list->addItem($item);
		}

		self::$Instance = null;
		
		$this->list = $this->setAttrs($this->list, $this->attributes);
		return $this->list;
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

}