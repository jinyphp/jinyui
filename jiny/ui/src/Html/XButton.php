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

    public function __construct($item=null)
    {
        parent::__construct();
        if ($item) {
            $this->addItem($item);
        }

        $this->addClass("btn"); //bootstrap css
        $this->shape = "basic";
    }

    public function setColor($color)
    {
        $this->color = $color;
        $this->addClass("btn-".$color);
        return $this;
    }


    public function skin($theme)
    {
        $this->skin = $theme;
    }

    public function setAttrs($attrs)
    {

        if (is_object($attrs) || is_array($attrs)) {           
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
                $this->addClass("btn-pill");
                unset($attrs["round"]);
            }

            if (isset($attrs["squre"])) {
                $this->addClass("btn-square");
                unset($attrs["squre"]);
            }

            // 버튼 사이즈
            if (isset($attrs["small"])) {
                $this->addClass("btn-sm");
                unset($attrs["small"]);
            }

            if (isset($attrs["large"])) {
                $this->addClass("btn-lg");
                unset($attrs["large"]);
            }

            // 드롭다운 클래스 추가
            if (isset($attrs["dropdown"])) {
                $this->dropdown();
                unset($attrs["dropdown"]);
            }



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

    public function dropdown()
    {
        $this->addClass("dropdown-toggle");
        $this->setAttribute("data-bs-toggle","dropdown");
        //$this->setAttribute("aria-haspopup","true");
        $this->setAttribute("aria-expanded","false");
        return $this;
    }


}