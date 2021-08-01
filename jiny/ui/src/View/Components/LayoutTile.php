<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class LayoutTile extends Component
{

    public $col;
    public function __construct($col=null)
    {
        if($col) {
            $this->col = 12/$col;
        } else {
            $this->col = 3;
        }
    
    }


    public function render()
    {

        return <<<'blade'
        <div class="col-12 col-md-6 col-lg-{{$col}}">
            {{ $slot }}
        </div>
    blade;
    }
}
