<?php

namespace Jiny\Action\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Actions 
{
    public $rules;

    public function __construct()
    {
        $this->rules = new \Jiny\Action\Rules();
    }
    
    /**
     * Action 정보에 맞는 목록을 출력합니다.
     *
     * @param  mixed $id
     * @return void
     */
    public function index(...$id)
    {
        return view($this->rules->listView(),[
            'createLink' => $this->createLink($id),
            'rules'=>$this->rules->get()
        ]);
    }

    private function createLink($id)
    {
        if ($id) {
            $this->rules->attrs['nested_id'] = $id[0];
            return route(currentRouteName().'.create', $id[0]);
        } else {
            return route(currentRouteName().'.create');
        }
    }

    
    
    /**
     * 신규 데이터 삽입
     *
     * @param  mixed $id
     * @return void
     */
    public function create(...$id)
    {
        if ($id) {
            $this->rules->attrs['nested_id'] = $id[0];
        } 

        return view($this->rules->editView(),[
            'rules'=>$this->rules->get()
        ]);
    }


    
    private function findDataRow($id)
    {
        $_data=[];
        
        $data = DB::table($this->rules->attrs['tablename'])->find($id);
        foreach ($data as $key => $value) {
            $_data[$key] = $value;
        }
        return $_data;
    }


    public function edit(...$id)
    {
        if(count($id)>1) {
            $this->rules->attrs['nested_id'] = $id[0];
            $this->rules->attrs['edit_id'] = $id[1];
            $this->rules->attrs['data'] = $this->findDataRow($id[1]);
        } else {
            $this->rules->attrs['edit_id'] = $id[0];
            $this->rules->attrs['data'] = $this->findDataRow($id[0]);
        }

        return view($this->rules->editView(),[
            'rules'=>$this->rules->attrs
        ]);
    }


}
