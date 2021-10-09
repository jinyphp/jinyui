<?php

namespace Jiny\Action\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Nested Fields Set
 */
class Fields 
{
    public $rules;

    public function __construct()
    {
        $this->rules = new \Jiny\Action\Rules();
        // dd($this->rules);
    }

    
    /**
     * 리스트 목록을 출력합니다.
     *
     * @param  mixed $id
     * @return void
     */
    public function index(...$id)
    {
        if ($id) {
            $this->rules->attrs['nested_id'] = $id[0];
            $createLink = route(currentRouteName().'.create', $id[0]);
        } else {
            $createLink = route(currentRouteName().'.create');
        }

        // "jinyaction::fields.fields_list"
        return view($this->rules->listView(),[
            'createLink' => $createLink,
            'rules' => $this->rules->attrs
        ]);
    }


    public function create(...$id)
    {
        if ($id) {
            $this->rules->attrs['nested_id'] = $id[0];
        } 
        
        // "jinyaction::fields.fields_edit"
        return view($this->rules->editView(),[
            'rules'=>$this->rules
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

    //$nested_id, $id
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

        //"jinyaction::fields.fields_edit"
        return view($this->rules->editView(),[
            'rules'=>$this->rules
        ]);
    }

}
