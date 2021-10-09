<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;

class XFormItem
{
    /**
     * 싱글턴
     */
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {             
            self::$Instance = new self();
        } 
        return self::$Instance; 
    }

    public $label;
    public $item;
    public $slot;
    private function init()
    {
        $this->label = null;
        $this->item = null;
        $this->slot = null;
    }

    public function setSlot($slot)
    {
        $this->slot = $slot;
        return $this;
    }

    
    public function setLabel($title, $attrs=null)
    {
        if ($title) {
            $label = CLabel($title);
            $this->label = $this->setAttrs($label, $attrs);
        }

        $this->label->addClass("col-form-label"); // bootstrap css
        return $this;
    }

    public function getLabel($attrs=null)
    {
        if ($this->label && $attrs) {
            // 추가 속성이 있는 경우
            return $this->setAttrs($this->label, $attrs);
        }
        return $this->label;
    }


    public function setItem($item, $attrs=null)
    {
        $item = CDiv($item);
        $this->item = $this->setAttrs($item, $attrs);
        return $this;
    }

    public function getItem($attrs=null)
    {
        if ($this->item && $attrs) {
            // 추가 속성이 있는 경우
            return $this->setAttrs($this->item, $attrs);
        }
        return $this->item;
    }

    private function setAttrs($item, $attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "class") {
                    $item->addClass($value);
                    continue;
                }
                $item->setAttribute($name, $value);
            }
        }
        return $item;
    }

    private function renderLabel()
    {
        $label = xDiv($this->label);
        $label->addClass("col-sm-2"); //>= 576px
        $label->addClass("text-sm-end");

        return $label;
    }

    private function renderItem()
    {
        if ($this->item) {
            return $this->item->addClass("col-sm-10"); // bootstrap css
        }        
    }

    public function vertical()
    {
        $hor = xDiv();
        $hor->addItem($this->getLabel(['class'=>"form-label"])); // 라벨
        $hor->addItem($this->getItem()); // 아이템
        $hor->addClass('row'); //bootstrap css

        if ($this->slot) {
            $hor->addItem($this->slot);
        }        
        
        $this->init(); // 다음 작업을 위하여 초기화...
        return $hor;
    }

    public function horizontal()
    {
        $hor = xDiv();
        $hor->addItem($this->renderLabel()); // 라벨
        $hor->addItem($this->renderItem()); // 아이템
        $hor->addClass('row'); //bootstrap css

        if ($this->slot) {
            $hor->addItem($this->slot);
        }

        $this->init(); // 다음 작업을 위하여 초기화...
        return $hor;
    }

    public function inline()
    {
        $hor = xDiv();
        $hor->addItem($this->getLabel(['class'=>"visually-hidden"])); // 라벨
        $hor->addItem($this->getItem()); // 아이템
        $hor->addClass('row'); //bootstrap css

        if ($this->slot) {
            $hor->addItem($this->slot);
        }
        
        $this->init(); // 다음 작업을 위하여 초기화...
        return $hor;
    }

    public function __toString()
    {
        return "";
	}

}