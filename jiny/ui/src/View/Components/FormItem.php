<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class FormItem extends Component
{

    public function __construct()
    {
    }

    public function render()
    {   
        return view('jinyui::components.forms.item');    
    }
}
