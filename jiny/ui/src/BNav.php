<?php 
namespace Jiny\UI;

/**
 * BootStrap Nav
 */
class BNav 
{
    public $component;
    private static $Instance;
    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();

            //self::$Instance->component = (new \Jiny\Html\CTag('ul', true))->addClass("nav");

            return self::$Instance;
        } else {
            // 인스턴스가 중복
            return self::$Instance; 
        }
    }

    private $num = 0;
    private $headers=[];
    private $selected;
    private $_href=null;
    public function popHeaders()
    {
        $headers = $this->headers;
        $this->headers = [];
        return $headers;
    }

    public function setTab($slot, $attrs=null)
    {
        $item = $this->tabLink($slot, $attrs);
        array_push($this->headers, $item);
    }



    public function tabLink($slot, $attrs=null)
    {
        $link = CLink($slot)->addClass("nav-link")->setAttribute("data-bs-toggle","tab")->setAttribute("role","tab");

        // 컴포넌트에서 전달받은 속성을 추가함
        $link = $this->setAttrs($link, $attrs);

        // 탭 이동링크 생성
        if(isset($attrs['href'])) {
            $this->_href = $attrs['href'];
        } else {
            $this->_href =  uniqid('Tab'.$this->num."_");
            $this->num++;
            $link->setUrl("#".$this->_href);
        }
        return $link;
        //return CListItem($link)->addClass("nav-item");
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


    private $contents=[];
    
    public function popContents()
    {
        $contents = $this->contents;
        $this->contents = [];
        return $contents;
    }
    public function setContent($slot, $attrs=null)
    {
        $item = CDiv($slot)
            ->addClass("tab-pane")
            ->setAttribute("role", "tabpanel");

        // nav링크 href를 id값으로 사용
        if($this->_href) {
            $item->setAttribute("id",trim($this->_href,"#"));
            $this->_href = null;
        }

        // 컴포넌트에서 전달받은 속성을 추가함
        $item = $this->setAttrs($item, $attrs);

        array_push($this->contents, $item);
    }



    



}