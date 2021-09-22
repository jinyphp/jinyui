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

    public function mount()
    {
        // 전달받은 데이터를 입력폼데이터로 재설정
        if(isset($this->rules['data'])) {
            $this->_data = $this->rules['data'];
        }
    }

    public function render()
    {
        if(isset($this->rules['nested_id'])) {
            $this->nested =  $this->rules['nested_id'];
        }
        //$this->_data['list'] = 1;
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
}
