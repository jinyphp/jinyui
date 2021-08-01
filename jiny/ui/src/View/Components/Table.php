<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public $ui;
    public $rules;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rule=null)
    {
        $this->ui = "basic";

        // 테이블 처리 규칙
        $this->loadRules($rule);
        
    }

    public function loadRules($rule=null)
    {
        if ($rule) {
            $path = resource_path("rules/".$rule.".json");
            if (file_exists($path)) {
                $json = file_get_contents($path);
                $this->rules = json_decode($json,true);
                // $this->rules['path'] = $rule;
            } else {
                $this->rules['path'] = $path;
                file_put_contents($path, json_encode($this->rules,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
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
        if (!$this->rules) {
            return <<<'blade'
            <div>테이블 처리 규칙이 지정되어 있지 않습니다. <code> rule=코드명 </code> 를 추가해 주세요.</div>
        blade; 
        }

        return view('jinyui::components.table.table' );
    }
}
