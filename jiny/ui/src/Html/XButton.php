<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CButton;

/**
 * Button
 */
class xButton extends CButton
{
    private $skin = "bootstrap";
    private $shape;
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

            // 속성을 부여합니다.
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


    /**
     * 사용자 속성 분석
     */
    private function attrParser($attrs)
    {
        if (isset($attrs["color"])) {
            $this->setColor($attrs["color"]);
            unset($attrs["color"]);        
        } else {
            // 컬러명과 동일한 속성값이 있는 경우
            $attrs = $this->detectColor($attrs);
        }


        if ($this->color) {
            if (isset($attrs["outline"])) {
                $this->addClass("btn-outline-".$this->color);
                unset($attrs["btn-outline-".$this->color]);
            } else {
                $this->addClass("btn-".$this->color);
            }
        }


        ## 라운드 속성이 있는 경우
        if (isset($attrs["round"])) {
            $this->setRound();
            unset($attrs["round"]);
        }

        ## 정사각 속성이 있는 경우
        if (isset($attrs["square"])) {
            $this->setSquare();            
            unset($attrs["square"]);
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

    private function detectColor($attrs)
    {
        $colors = ["primary", "secondary", "success", "danger", "warning", "info"];
        foreach($colors as $key) {
            if (isset($attrs[$key])) {  
                $this->color = $key;                  
                unset($attrs[$key]);
            }
        }

        return $attrs;
    }

    public function setOutline($color=null)
    {
        if ($color) {
            $this->addClass("btn-outline-".$color);
        } else
        if ($this->color) {
            $this->addClass("btn-outline-".$this->color);
        }
        
        return $this;
    }
        
    /**
     * 라운드 속성을 추가합니다.
     *
     * @return void
     */
    public function setRound()
    {
        $this->addClass("btn-pill");
        return $this;
    }

    public function setSquare()
    {
        $this->addClass("btn-square");
        return $this;
    }

    public function setHref($url)
    {
        $this->setAttribute("onclick", "location.href='".$url."'");
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