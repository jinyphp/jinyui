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
            // 해더배열 전달
            $this->rows = $rows;
        } else 
        // Json으로 해더정보 전달
        if ($json) {
            $this->rows = json_decode($json,true);
        }
        
    }

    public function render()
    {
        return view('jinyui::components.tables.thead' );
    }
}
