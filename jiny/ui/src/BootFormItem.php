<?php 
namespace Jiny\UI;

class BootFormItem
{
    /**
     * 싱글턴
     */
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {             
            self::$Instance = new self();
            return self::$Instance;
        } else {
            return self::$Instance; //중복
        }
    }


    public $tag;
    public function start()
    {
        $this->tag = true;
    }


    // 라벨지정
    public $label;
    public function setLabel($title, $attrs=null)
    {
        if ($title) {
            $label = CLabel($title);
            $this->label = $this->setAttrs($label, $attrs);
        }
    }

    public function getLabel($attrs=null)
    {
        if ($this->label && $attrs) {
            // 추가 속성이 있는 경우
            return $this->setAttrs($this->label, $attrs);
        }
        return $this->label;
    }
    

    public $item;
    public function setItem($item, $attrs=null)
    {
        $item = CDiv($item);
        $this->item = $this->setAttrs($item, $attrs);
    }

    public function getItem($attrs=null)
    {
        if ($this->item && $attrs) {
            // 추가 속성이 있는 경우
            return $this->setAttrs($this->item, $attrs);
        }
        return $this->item;
    }


    public function clear()
    {
        $this->label = null;
        $this->item = null;
        $this->tag = false;
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

    // 출력:bootstrap
    public function hor($attrs)
    {
        $itemRow = CDiv()
            ->addItem(
                CDiv(
                    $this->label->addClass("col-form-label")
                    //$this->getLabel(['class'=>"col-form-label"])
                )
                ->addClass("col-sm-2") //>= 576px
                ->addClass("text-sm-end")
            )
            ->addItem(
                $this->item->addClass("col-sm-10")
                //$this->getItem(['class'=>"col-sm-10"])
            )
            ->addClass("row");

        $this->clear(); //속성값 제거

        return $this->setAttrs($itemRow, $attrs);
    }



}