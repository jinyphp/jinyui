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

    public function index(...$id)
    {
        if ($id) {
            $this->rules->attrs['nested_id'] = $id[0];
            $createLink = route(currentRouteName().'.create', $id[0]);
        } else {
            $createLink = route(currentRouteName().'.create');
        }

        // "jinyaction::actions.action_list"
        return view($this->rules->listView(),[
            'createLink' => $createLink,
            'rules'=>$this->rules->get()
        ]);
    }

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
