<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LiveFieldCreate extends Component
{
    public $rules;
    public $nested;
    public $_data = [];



    public $_tabs = 0; // tabbar 선택시...
    public function tab($tab)
    {
        $this->_tabs = $tab;
    }

    public function mount()
    {
        // 전달받은 데이터를 입력폼데이터로 재설정
        /*
        if(isset($this->rules['data'])) {
            $this->_data = $this->rules['data'];
        }
        */

        // Controller View에서 전달받은  
        if (isset($this->rules['data'])) {
            // 데이터를 입력폼데이터로 재설정
            $this->setData($this->rules['data']);
        } else {
            // 데이터 없음, 기본값 설정
            if(isset($this->rules['fields']) && is_array($this->rules['fields'])) {
                foreach($this->rules['fields'] as $field) {
                    $this->setDefaultData($field);
                }
            }

            # 강제 초기값 지정
            $this->_data['list_type'] = "field";
            $this->_data['input'] = "text";

        }
    }

    private function setData($data)
    {
        $this->_data = $data;
    }

    private function setDefaultData($field)
    {
        if($field['form'] && $field['default']) {
            if($name = $field['name']){ //필드명
                $this->_data[$name] = $field['default'];
            }                    
        }
    }



    public function render()
    {
        if(isset($this->rules['nested_id'])) {
            $this->nested =  $this->rules['nested_id'];
        }

        //dd($this->_data);

        return view("jinyaction::livewire.liveFieldCreate");
    }

    public function store()
    {
        if(isset($this->rules['nested_id'])) {
            $this->_data['nested_id'] = $this->rules['nested_id'];

            $nested_field = $this->rules['nested']['tablename']."_id";
            $this->_data[ $nested_field ] = $this->rules['nested_id'];
        }        

        $master_id = DB::table("action_field")
            ->insertGetId($this->_data);
        
        return $this->redirectToIndex();
    }

    public function update()
    {
        /*
        $fields = DB::table("action_field")
        ->where('actions_id', $this->rules['nested_id'])
        ->get();
        dd($fields);
        */



        // 데이터 수정
        DB::table("action_field")
        ->where('id', $this->rules['edit_id'])
        ->update($this->_data);

        return $this->redirectToIndex(); 
    }

    public function delete()
    {
        if(isset($this->rules['edit_id'])) {
            //$ForeinKey = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ));

            // DB 데이터를 삭제합니다.
            DB::table($this->rules['tablename'])
            ->where('id', $this->rules['edit_id'])
            ->delete();

            /*
            foreach ($ForeinKey->forein as $type => $arr) {
                if($type == "=" ) { 
                    // 1:1
                } else {
                    // 1:N, M:N 삭제
                    $ForeinKey->foreinDelete($this->rules['edit_id']);
                }
            }
            */
        
        }

        return $this->redirectToIndex();
    }

    private function redirectToIndex()
    {
        if(isset($this->rules['nested_id'])) {
            return redirect()
                ->to( route($this->rules['routename'].'.index', $this->rules['nested_id']) ); 
        }
        
        return redirect()
            ->to( route($this->rules['routename'].'.index') ); 
    }

    public function clear()
    {
        $this->_data = [];
    }
}
