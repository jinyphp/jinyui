<?php 
namespace Jiny\UI;

class BCard
{
    private static $Instance;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();

            return self::$Instance;
        } else {
            // 인스턴스가 중복
            return self::$Instance; 
        }
    }

    public $before;
    public function setBefore($slot)
    {
        $this->before = $slot;
    }



    public $header;
    public function setHeader($slot, $attrs=null)
    {
        $item = CDiv($slot)->addClass("card-header");
        $this->header = $this->setAttrs($item, $attrs);
    }

    public function getHeader()
    {
        return $this->header;
    }

    public $body;
    public function setBody($slot, $attrs=null)
    {
        $item = CDiv($slot)->addClass("card-body");
        $this->body = $this->setAttrs($item, $attrs);
    }

    public function getBody()
    {
        return $this->body;
    }

    public $footer;
    public function setFooter($slot, $attrs=null)
    {
        $item = CDiv($slot)->addClass("card-footer");
        $this->footer = $this->setAttrs($item, $attrs);
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public $after;
    public function setAfter($slot)
    {
        $this->after = $slot;
    }

    public function clear()
    {
        $this->before = null;
        $this->header = null;
        $this->body = null;
        $this->footer = null;
        $this->after = null;
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