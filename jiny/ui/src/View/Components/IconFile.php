<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class IconFile extends Component
{
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        return view('jinyui::components.icon'.$this->path);
    }
}
