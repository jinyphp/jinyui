<?php

namespace App\View\Components;

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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.hello');
    }
}
