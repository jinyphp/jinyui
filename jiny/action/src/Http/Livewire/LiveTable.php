<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LiveTable extends Component
{
    public $rules;
    public $nested;
    public $viewfile;

    private function isNested()
    {
        if(isset($this->rules['nested_id'])) {
            return $this->rules['nested_id'];
        }
    }

    public function render()
    {
        $this->nested = $this->isNested();

        // 데이터 목록을 읽어 옵니다.
        $datas = $this->selectDataRows();

        return view($this->viewfile, [
            'ActionTable'=> new \Jiny\Action\ActionTable($this->rules, $datas),
            'rows'=>$datas
        ]);
    }

    // === Admin Mode Method ===

    
    // 필드정보 라이브 수정
    public $editListField = false;
    public $_data=[];
    public function setListField($id)
    {
        $row = DB::table("action_field")->where('id',$id)->first();
        foreach($row as $key => $value) {
            $this->_data[$key] = $value;
        }
        
        $this->editListField = true;
    }

    public function changeListField()
    {
        // 데이터 수정
        DB::table("action_field")
        ->where('id', $this->_data['id'])
        ->update($this->_data);

        $this->editListField = false;
        $this->_data = [];      
    }

    public $addListField = false;
    public $_fields=[];
    //public $_ids=[];
    public function setAddListField()
    {
        $this->addListField = true;
        $rows = DB::table("action_field")->where('actions_id',$this->rules['id'])
        ->orderBy('list_pos',"asc")->get();
        foreach($rows as $key => $row) {
            $this->_fields[$key]['id'] = $row->id;
            $this->_fields[$key]['title'] = $row->title;
            $this->_fields[$key]['description'] = $row->description;
            $this->_fields[$key]['list'] = $row->list;
        }
    }



    public function ListFieldAdd()
    {
        $this->addListField = false;
        //dd($this->_fields);
        //$DB = DB::table("action_field");
        foreach($this->_fields as $item) {
            DB::table("action_field")->where('id', $item['id'])->update($item);            
        }
        
    }






}