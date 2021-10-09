<?php
namespace Jiny\Action;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Jiny\Html\CTag;

class ActionTable
{
    public $rules = [];
    public $fields = [];
    public $rows = [];

    public $admin = true;

    public function __construct($rules, $data)
    {
        $this->rules = $rules;

        
        $this->fields = DB::table("action_field")
            ->where('actions_id', $rules['id'])
            ->orderBy('list_pos',"asc")
            ->get();

        $this->rows = $data;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }


    public function build($class=null)
    {
        $table = (new \Jiny\Html\CTag("table",true));
        $table->addItem($this->thead());
        $table->addItem($this->tbody());

        if($class) {
            $table->addClass($class);
        }

        return $table
            ->addClass("table datatable");
    }


    public function thead()
    {
        $_th = (new \Jiny\Html\CTag("th",true));        
        $tr = new \Jiny\Html\CTag("tr",true);

        
        $th = (clone $_th)
                ->addStyle("width: 20px;")
                ->addItem(xTableCheckAll()); 
        $tr->addItem($th);

        foreach($this->fields as $item) {
            
            //리스트 출력
            if ($item->list) {
                $th = (clone $_th);

                // 관리자모드
                if($this->admin) {
                    $setting = xLink("*")->setAttribute("wire:click","setListField(".$item->id.")");
                    $th->addItem(
                        (new \Jiny\Html\CTag("span",true))
                        ->addItem($setting)
                    );

                    $th->addItem(
                        (new \Jiny\Html\CTag("span",true))
                        ->addItem($item->title)
                    );

                } else {
                    $th->addItem($item->title);
                }

                $tr->addItem($th);
            }

        }

        return (new \Jiny\Html\CTag("thead",true))
            ->addItem($tr);
    }





    public function tbody()
    {
        $tbody = (new \Jiny\Html\CTag("tbody",true));
        $_td = (new \Jiny\Html\CTag("td",true));
        $_tr = new \Jiny\Html\CTag("tr",true);

        
        foreach ($this->rows as $row) {
            $tr = clone $_tr;

            $td = (clone $_td)
                ->addStyle("width: 20px;")
                ->addItem(xTableCheckRow($row->id)); 
            $tr->addItem($td);


            foreach($this->fields as $item) {
                if ($item->list) { //리스트 출력모드
                    $td = $this->cellParser($item, $row);
                    $tr->addItem($td);
                } 
            }

            $tbody->addItem($tr);
                
        }

        return $tbody;
    }

    // ===

    private function cellParser($item, $row)
    {
        $td = (new \Jiny\Html\CTag("td",true));

        // 필드값 출력
        if ($item->list_type == "field") {
            $value = $this->displayField($item, $row);
            if($item->list_edit) {
                $cell = xLink($value, route($this->rules['routename'].'.edit', $row->id));
            } else {
                $cell = $value;
            }
            
        } else 
        // html 출력
        if ($item->list_type == "html") {
            $cell = $this->displayHtml($item, $row);
        } else 
        if ($item->list_type == "link") {
            $cell = $this->displayLink($item, $row);
        } else {
            $cell = "";
        }

        // TD 셀에 css 스타일을 지정합니다.
        if ($item->list_style) {
            $td->addStyle($item->list_style);
        }

        return $td->addItem($cell);

    }


    
    /**
     * 필드의 정보를 출력합니다.
     *
     * @param  mixed $item
     * @param  mixed $row
     * @return void
     */
    private function displayField($item, $row)
    {
        if($name = $item->list_value) { // 필드명이 존재하는지 검사...
            //$name = $item->list_value;   
            
            //dd($name);

            if(isset($row->{$name})) { //필드명과 일치하는 데이터 있는지 검사...
                return $row->{$name};
            }                   
        } 
    }
    
    /**
     * HTML을 출력합니다.
     *
     * @param  mixed $item
     * @param  mixed $row
     * @return void
     */
    private function displayHtml($item, $row)
    {
        return $item->list_value;
    }
    
    /**
     * 링크를 생성하여 출력합니다.
     *
     * @param  mixed $item
     * @param  mixed $row
     * @return void
     */
    private function displayLink($item, $row)
    {
        if($item->list_value) {
            // {필드명} 대체
            $link = $this->tagReplaceField($item->list_value, $row);
            
            ## 링크 타이틀
            if($item->list_link_text) {
                // {필드명} 대체
                $title = $this->tagReplaceField($item->list_link_text, $row);
            } else {
                $title = "";
            }

            return xLink($title,$link);
        }
    }

    private function tagReplaceField($url, $row)
    {
        // 링크코드 파싱
        $key = [];
        $code = false;

        for ($i=0, $j=0; $i<strlen($url);$i++) {
            if($url[$i] == "{") {
                $code = true;
                $key[$j] = "";
                continue;
            } else if($url[$i] == "}") {
                $code = false;
                $j++;
                continue;
            }

            if ($code) {
                $key[$j] .= $url[$i];
            }
        }

        foreach($key as $field) {
            $url = str_replace("{".$field."}", $row->$field, $url);
        }

        return $url;
    }

}