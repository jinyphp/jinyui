<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CButton;

/**
 * BootStrap Button
 */
class xButton extends CButton
{
    private $skin = "bootstrap";
    private $shape;
    //private $colorset = "primary";
    private $color;

    public function skin($theme)
    {
        $this->skin = $theme;
    }

    public function __construct($item=null)
    {
        parent::__construct();
        if ($item) {
            $this->addItem($item);
        }

        $this->addClass("btn"); //bootstrap css
        // $this->shape = "basic";
    }

        


    
    /**
     * 속성을 부여합니다.
     *
     * @param  mixed $attrs
     * @return void
     */
    public function setAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            // 커스텀 속성을 분석합니다.     
            $attrs = $this->attrParser($attrs);

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

    private function attrParser($attrs)
    {
        //버튼 타입 parsing
        foreach(["primary", "secondary", "success", "danger", "warning", "info"] as $key) {
            if (isset($attrs[$key])) {     
                if (isset($attrs["outline"])) {
                    $this->addClass("btn-outline-".$key);
                    unset($attrs["btn-outline-".$key]);
                } else {
                    $this->addClass("btn-".$key);
                }
                unset($attrs[$key]);
            }
        }    

        // 버튼 모양
        if (isset($attrs["round"])) {
            $this->setRound();
            unset($attrs["round"]);
        }

        if (isset($attrs["squre"])) {
            $this->setSqure();            
            unset($attrs["squre"]);
        }

        // 버튼 사이즈
        if (isset($attrs["small"])) {
            $this->setSize("small");
            unset($attrs["small"]);
        }

        if (isset($attrs["large"])) {
            $this->setSize("large");
            unset($attrs["large"]);
        }

        // 드롭다운 클래스 추가
        if (isset($attrs["dropdown"])) {
            $this->dropdown();
            unset($attrs["dropdown"]);
        }

        // 링크추가, href 속성을 onclick으로 변경함
        if (isset($attrs["href"])) {
            $this->setHref($attrs["href"]);
            unset($attrs["href"]);
        }

        return $attrs;
    }

    /**
     * 컬러를 설정합니다.
     *
     * @param  mixed $color
     * @return void
     */
    public function setColor($color)
    {
        $this->color = $color;
        $this->addClass("btn-".$color);
        return $this;
    }

    public function setRound()
    {
        $this->addClass("btn-pill");
        return $this;
    }

    public function setSqure()
    {
        $this->addClass("btn-square");
        return $this;
    }

    public function setHref($url)
    {
        $this->setAttribute("onclick","location.href='".$url."'");
        $this->addStyle("cursor: pointer;"); // 마우스 포인터 
        return $this;
    }

    public function setSize($size)
    {
        if ($size == "small") {
            $this->addClass("btn-sm");
        } else if ($size == "large") {
            $this->addClass("btn-lg");
        }       

        return $this;
    }



    // 기능변경


    public function dropdown()
    {
        $this->addClass("dropdown-toggle");
        $this->setAttribute("data-bs-toggle","dropdown");
        $this->setAttribute("aria-expanded","false");
        return $this;
    }


}