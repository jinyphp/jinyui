<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class Hello extends Component
{
    public $hello;
    

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->hello = "안녕하세요";
    }

    private $attrs;
    public function setAttrs($attributes)
    {
        $attributes['class'] .= "w-4 h-4'";
        $this->attrs = $attributes;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.hello');
    }
}
