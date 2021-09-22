<?php

namespace Jiny\UI\View\Components\Button;

use Illuminate\View\Component;

class Badge extends Component
{
    public $title;
    public $attr;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title=null, $attr=[])
    {
        $this->title = $title;
        $this->attr = $attr;
    }


    public function setAttrs($attributes)
    {
        // 기본 베지 설정
        if (isset($attributes['class'])) {
            $attributes['class'] .= " badge";
        } else {
            $attributes['class'] = "badge";
        }

        $this->attributes = $attributes;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.button.badge');
    }

    public function __toString()
    {
        $obj = CSpan($this->title)->addClass("badge");

        foreach($this->attr as $attr => $value) {
            if ($attr == "class") {
                $obj->addClass($value);
            }
            /*
            if (method_exists($this,"setClass_".$attr)) {
                $obj = $this->{"setClass_".$attr}($obj);
            }
            */
        }

        return $obj->toString();
	}

    private function setClass_primary($obj)
    {
        return $obj->addClass("bg-primary");
    }

    private function setClass_secondary($obj)
    {
        return $obj->addClass("bg-secondary");
    }

    private function setClass_success($obj)
    {
        return $obj->addClass("bg-success");
    }

    private function setClass_danger($obj)
    {
        return $obj->addClass("bg-danger");
    }

    private function setClass_info($obj)
    {
        return $obj->addClass("bg-info");
    }

    private function setClass_light($obj)
    {
        return $obj->addClass("bg-light");
    }

    private function setClass_dark($obj)
    {
        return $obj->addClass("bg-dark");
    }

    


}
