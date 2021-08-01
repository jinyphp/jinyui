<?php 
namespace Jiny\UI;
use Illuminate\Support\Facades\Blade;
class CTab 
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

    

    private $headers=[];
    private $selected;
    public function popHeaders()
    {
        $headers = $this->headers;
        $this->headers = [];
        return $headers;
    }

    public function pushHeader($slot, $attrs=null)
    {
        $item = $this->link($slot, $attrs);    
        array_push($this->headers, $item);
        // return $this; //블래이드 호출반환 없음
    }

    public function link($slot, $attrs=null)
    {
        $item = CLink($slot)
            ->addClass("list-group-item")
            ->addClass("list-group-item-action")
            ->setAttribute("role","tab")
            ->setAttribute("aria-selected","false");

        $item->setAttribute("data-bs-toggle", "list");
        
        // 컴포넌트에서 전달받은 속성을 추가함
        $item = $this->setAttrs($item, $attrs);
        return $item;
    }

    public function links($arr=[], $selected=null)
    {
        foreach($arr as $key =>$value) {
            $item = $this->link($value, ['href'=>"#".$key]);
            if($selected) {
                if($key == $selected) {
                    $item->addClass("active");
                    $this->selected = $key;
                }
            }
            
            array_push($this->headers, $item);
            //$this->headers[$key] = $item;
        }
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