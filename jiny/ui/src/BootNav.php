<?php 
namespace Jiny\UI;

/**
 * BootStrap Nav
 */
class BootNav 
{
    public $component;

    /**
     * multi 싱글턴 로직
     */
    public static $Instance=[];
    public static $_ri=0; // 인스턴스 스택관리 index
    public static $_step=0;
    
    // 싱글턴 인스턴스 생성.
    // 현재 _ri 선택된 인스턴스를 반환합니다.
    public static function instance($ri=null)
    {
        if ($ri) {
            $index = $ri;
        } else {
            $index = self::$_ri;
        }

        if (!isset(self::$Instance[ $index ])) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance[ $index ] = new self();

            return self::$Instance[ $index ];
        } else {
            // 인스턴스가 중복
            return self::$Instance[ $index ]; 
        }
    }

    // 새로운 인스턴스를 생성합니다.
    public static function init()
    {
        self::$_ri++;
        //return self::instance();
    }

    // 현재 인스턴스를 삭제하고, 상위 인스턴스 스택을 반환합니다.
    public static function destory()
    {
        unset(self::$Instance[ self::$_ri ]);
        self::$_ri--;
    }

    /**
     * 실제 동작로직
     */


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
        // 부트스트랩 기본 스타일
        //$title = $slot."(".self::$_step++."=".self::$_ri.")";
        $title = $slot;
        $link = CLink($title)->addClass("nav-link")
            ->setAttribute("data-bs-toggle","tab")
            ->setAttribute("role","tab");

        // 컴포넌트에서 전달받은 사용자 지정 속성
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