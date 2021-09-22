<?php

namespace Jiny\UI\View\Components\Tables;

use Illuminate\View\Component;

class TableBody extends Component
{
    public $json=null;
    public $rows=[];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($json=null, $rows=[])
    {
        if ($rows) {
            $this->rows = $rows;
        } else {
            if ($json) {
                $this->rows = json_decode($json,true);
            }
        }       
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.tables.tbody');
    }


}
