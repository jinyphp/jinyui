<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LiveActionCreate extends Component
{
    public $rules;
    public $nested;
    public $_data = [];

    

    public function mount()
    {
        // 전달받은 데이터를 입력폼데이터로 재설정
        if (isset($this->rules['data'])) {            
            $this->_data = $this->rules['data'];
        }        
    }

    public function render()
    {
        if(isset($this->rules['nested_id'])) {
            $this->nested =  $this->rules['nested_id'];
        }

        return view("jinyaction::livewire.liveActionCreate");
    }

    public function store()
    {
        if (isset($this->_data['prefix'])) {
            $this->_data['name'] = str_replace('/','-',$this->_data['prefix']) ."-". $this->_data['uri'];
        } else {
            $this->_data['name'] = $this->_data['uri'];
        }

        if(isset($this->rules['nested_id'])) {
            $this->_data['nested_id'] = $this->rules['nested_id'];
        }        

        $master_id = DB::table("actions")
            ->insertGetId($this->_data);

        return $this->redirectToIndex();     
    }

    public function update()
    {
        if (isset($this->_data['prefix'])) {
            $this->_data['name'] = ltrim(str_replace('/','-',$this->_data['prefix']),'-') ."-". $this->_data['uri'];
        } else {
            $this->_data['name'] = $this->_data['uri'];
        }

        // 데이터 수정
        DB::table("actions")
        ->where('id', $this->rules['edit_id'])
        ->update($this->_data);

        return $this->redirectToIndex();  
    }

    private function redirectToIndex()
    {
        if(isset($this->rules['nested_id'])) {
            return redirect()->to( route($this->rules['routename'].'.index', $this->rules['nested_id']) ); 
        }
        
        return redirect()->to( route($this->rules['routename'].'.index') ); 
    }

    /**
     * 수정모드 인지 확인
     */
    private function isEditMode()
    {
        if(isset($this->rules['edit_id']) && is_numeric($this->rules['edit_id'])) {
            return true;
        }
        return false;
    }



}
