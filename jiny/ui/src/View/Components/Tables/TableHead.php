<?php

namespace Jiny\UI\View\Components\Tables;

use Illuminate\View\Component;

class TableHead extends Component
{
    public $json=null;
    public $rows=[];

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

    public function render()
    {
        return view('jinyui::components.tables.thead' );
    }
}
