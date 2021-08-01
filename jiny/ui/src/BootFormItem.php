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
        //dd($this->tag);
    }

    public $label;
    public function setLabel($title, $attrs=null)
    {
        //dd($this->tag);
        if ($title) {
            $label = CLabel($title);
            $this->label = $this->setAttrs($label, $attrs);
            
            // 시작테그가 없는 경우, 결과값 바로 반환
            //dd($this->tag);
            //if($this->tag === false) return $this->label;
        }
    }

    public function getLabel($attrs=null)
    {
        // 추가 속성이 있는 경우
        if ($this->label && $attrs) {
            return $this->setAttrs($this->label, $attrs);
        }

        return $this->label;
    }
    

    public $item;
    public function setItem($item, $attrs=null)
    {
        $item = CDiv($item);
        $this->item = $this->setAttrs($item, $attrs);

        // 시작테그가 없는 경우, 결과값 바로 반환
        //if(!$this->tag) return $this->item;
    }

    public function getItem($attrs=null)
    {
        // 추가 속성이 있는 경우
        if ($this->item && $attrs) {
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

}