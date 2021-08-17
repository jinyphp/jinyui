<?php

namespace Jiny\UI\View\Components\Layouts;

use Illuminate\View\Component;

class Layout extends Component
{
    public $attr;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.layout.layout');
    }

    public function setAttrs($attributes)
    {
        $this->attributes = $attributes;
    }

    public function isAttr($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
        return false;
    }
}
