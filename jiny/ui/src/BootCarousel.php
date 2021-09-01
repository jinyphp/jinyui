<?php 
namespace Jiny\UI;

class BootCarousel
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

    public $stack=[];
    public function addItem($slot, $attrs)
    {
        array_push($this->stack, ['slot'=>$slot, 'attrs'=>$attrs]);
    }

    public function clear()
    {
        $this->stack=[];
        $this->_uid = null;
    }

    public $_uid;
    public function uid()
    {
        if($this->_uid) {
            return $this->_uid;
        } else {
            $this->_uid = uniqid("_carousel_".random_int(0,1000));
            return $this->_uid;
        }
    }



    public $attrs;
    public $controls;
    public $indicator;
    public function setAttrs($attrs)
    {
        if (isset($attrs["controls"])) {
            unset($attrs["controls"]);
            $this->controls = true;
        }

        if (isset($attrs["indicator"])) {
            unset($attrs["indicator"]);
            $this->indicator = true;
        }

        $this->attrs = $attrs;
    }

    
}