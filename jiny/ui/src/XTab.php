<?php 
namespace Jiny\UI;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class XTab 
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

    public $_style="list";
    private $headers=[];
    private $selected;
    private $_attributes = [];
    private $_active;

    public function tabStyle($style)
    {
        $this->_style = $style;
        return $this;
    }

    public function setTabAttrs($attributes)
    {
        if(isset($attributes['group'])){
            $this->_style = "group";
            unset($attributes['group']);
        }

        if(isset($attributes['list'])){
            $this->_style = "list";
            unset($attributes['list']);
        }

        $this->_attributes['tab'] = $attributes;
        return $this;
    }

    
    public function popHeaders()
    {
        $headers = [];

        foreach($this->headers as $item) {
            $headers []= $this->link($item['slot'], $item['attrs']);
        }
        
        $this->headers = []; //초기화
        return $headers;
    }


    // 텝 항목을 스텍에 저장합니다.
    public function pushHeader($slot, $attrs=null)
    {
        $active=false;
        if (isset($attrs['class']) && Str::contains($attrs['class'], 'active') ) {
            $active = true;
        } else if (isset($attrs['active'])) {
            unset($attrs['active']);
            $active=true;
        }
        if ($active) {
            $this->_active = trim($attrs['href'], '#');
            $attrs['class'] .= " active";
        }
    
        array_push($this->headers, ['slot'=>$slot, 'attrs'=>$attrs]);
    }

    public function link($slot, $attrs=null)
    {
        $item = CLink($slot);
        if($this->_style == "list") {
            $item->addClass("list-group-item")
            ->addClass("list-group-item-action")
            ->setAttribute("role","tab")
            ->setAttribute("aria-selected","false");

            $item->setAttribute("data-bs-toggle", "list");

        } else if($this->_style == "group") {
            // toggle tab
            $item->setAttribute("data-bs-toggle", "tab");
        }
        
        
        // 컴포넌트에서 전달받은 속성을 추가함
        $item = $this->setAttrs($item, $attrs);
        return $item;
    }

    
    /**
     * 복수의 리스트 목록을 설정합니다.
     *
     * @param  mixed $arr
     * @param  mixed $selected : Active 기본설정항목
     * @return void
     */
    public function links($arr=[], $selected=null)
    {
        
        foreach($arr as $key =>$value) {
            // Active 설정
            if($selected) {
                if($key == $selected) {
                    $attrClass = "active";
                    $this->_active = $key;
                } else {
                    $attrClass = "";
                }
            }

            // 항목추가
            $this->addItem(
                $this->makeItem($value, ['href'=>"#".$key, 'class'=>$attrClass]  )
            );
        }
    }

    private function makeItem($slot, $attrs)
    {
        return ['slot'=>$slot, 'attrs'=>$attrs];
    }

    public function addItem($item)
    {
        array_push($this->headers, $item);
        return $this;
    }



    private $contents=[];
    public function popContents()
    {
        $contents = $this->contents;
        $this->contents = [];
        return $contents;
    }
    public function pushContent($slot, $attrs=null)
    {
        
        $item = CDiv($slot)
            ->addClass("tab-pane")
            ->addClass("fade")
            ->setAttribute("role", "tabpanel");

        //if (isset($attrs['class']) && !Str::contains($attrs['class'], 'active') ) {
            if($this->_active == $attrs['id']) {
                $attrs['class'] .= " active show";
            }
        //}

        // 컴포넌트에서 전달받은 속성을 추가함
        $item = $this->setAttrs($item, $attrs);

        array_push($this->contents, $item);
        //return $this;
    }

    /*
    public function addPath($path, $id=null)
    {
        $attrs = ['id'=>$id];
        if ($id == $this->selected) {
            $attrs['class'] = "active show";
        }

        $path = Blade::stripParentheses($path);
        
    
        $viewBasePath = Blade::getPath();
        return $viewBasePath;
        
        // foreach ($this->app['config']['view.paths'] as $path) {
        //     if (substr($viewBasePath,0,strlen($path)) === $path) {
        //         $viewBasePath = substr($viewBasePath,strlen($path));
        //         break;
        //     }
        // }
    
        $viewBasePath = dirname(trim($viewBasePath,'\/'));
        $path = substr_replace($path, $viewBasePath.'.', 1, 0);
        //$body = $__env->make($path, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render();
        return $path;

        $this->pushContent($body, $attrs);
    }
    */

    

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



}