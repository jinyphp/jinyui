<?php

namespace Jiny\UI\View\Components\Tables;

use Illuminate\View\Component;

class Table extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyui::components.tables.table' );
    }




    //public $ui;
    //public $rules;

    /*
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

    // 테이블 빌드
    public function tableBuild($slot, $attrs)
    {
        $table = (new \Jiny\Html\Table\CTable())->addClass("table");
        $table = $this->tableStyle($table, $attrs);
        $table = $this->setAttrs($table, $attrs);

        // Head, Body 데이터 생성
        $table
            ->addItem(\Jiny\UI\Table::instance()->dataHead())
            ->addItem(\Jiny\UI\Table::instance()->dataBody());

        //
        if($slot) {
            $table->addItem($slot);
        }

        \Jiny\UI\Table::instance()->init();
        return $table;
    }

    // 테이블 스타일, 클래스 추가
    private function tableStyle($table, $attrs)
    {
        // BulkCheck
        if(isset($attrs['check'])) {
            unset($attrs['check']);
            \Jiny\UI\Table::instance()->check();
        }


        if(isset($attrs['striped'])) {
            unset($attrs['striped']);
            $table->addClass("table-striped");
        }

        if(isset($attrs['condensed'])) {
            unset($attrs['condensed']);
            $table->addClass("table-striped table-sm");
        }

        if(isset($attrs['hoverable'])) {
            unset($attrs['hoverable']);
            $table->addClass("table-hover");
        }

        if(isset($attrs['bordered'])) {
            unset($attrs['bordered']);
            $table->addClass("table-bordered");
        }

        if(isset($attrs['contextual'])) {
            unset($attrs['contextual']);
            //$table->addClass("table-bordered");
        }

        if(isset($attrs['response'])) {
            unset($attrs['response']);
            $table->addClass("table-responsive");
        }

        return $table;
    }


    private function setAttrs($item, $attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "href") {
                    $item->setUrl($value);
                    continue;
                } else if ($name === "class") {

                    $item->addClass($value);
                    continue;
                }
                $item->setAttribute($name, $value);
            }
        }
        return $item;
    }

    */


}
