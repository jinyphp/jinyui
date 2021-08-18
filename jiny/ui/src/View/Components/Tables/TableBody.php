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
        /*
        if (!$this->rules) {
            return <<<'blade'
            <div>테이블 처리 규칙이 지정되어 있지 않습니다. <code> rule=코드명 </code> 를 추가해 주세요.</div>
        blade; 
        }
        */

        return view('jinyui::components.tables.tbody');
    }
}
