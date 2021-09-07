<?php 
namespace Jiny\UI\Components;

use Jiny\Html\Ctag;

class XAccordion
{
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();
        } 
        return self::$Instance; 
    }


    public $stack=[];

    public function push($value)
    {
        array_push($this->stack, $value);
        return $this;
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public $uid;
    public function getId($salt=null)
    {
        if(!$this->uid) {
            $this->uid = uniqid($salt."_");
        }        
        return $this->uid;
    }

    public $_attrs;
    public function setAttributes($attrs)
    {
        $this->_attrs = $attrs;
    }

    public function isAttr($key)
    {
        //dd($this->_attrs);
        if (isset($this->_attrs[$key])) {
            return true;
        }
        return false;
    }


    public function clear()
    {
        $this->uid = null;
        $this->stack=[];
        $this->_accordion = null;
        $this->_attrs = null;
    }

    public $_accordion;
    public function accordionId()
    {
        if($this->_accordion) {
            $accordion = $this->_accordion;
            //$this->_accordion = null;
            return $accordion;
        } else {
            $this->_accordion = uniqid("_accordion_".random_int(0,1000));
            return $this->_accordion;
        }
    }

    /**
     * collapse id를 관리합니다.
     */
    public $_collapse;
    public function collapseId()
    {
        if($this->_collapse) {
            // 캐쉬된 아이디 존재
            // Body에서 collapse id 읽을때
            $collapse = $this->_collapse;
            $this->_collapse = null;
            return $collapse;
        } 
        // collapse id 생성
        else {
            $this->_collapse = uniqid("_collapse_".random_int(0,1000));
            return $this->_collapse;
        }
    }

    
}