<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

Class LiveData
{
    public $rules;
    public $db;

    public function __construct($rules)
    {   
        $this->rules = $rules;
    }

    public function isRuleTable()
    {
        if (isset($this->rules['tablename'])) {
            return $this->rules['tablename'];
        }

        return false;
    }

    public function dbTable($tablename)
    {
        $this->db = DB::table($tablename);

        if($nested = $this->isNested() ) {
            $nested_field = $this->rules['nested']['tablename']."_id";
            $this->db->where($nested_field, $nested);
        }

        return $this;
    }

    public function orderBy($field, $sort)
    {
        $this->db->orderBy($field, $sort);
        return $this;
    }

                    
    public function paginate($num = 10)
    {
        return $this->db->paginate($num);
    }

    private function isNested()
    {
        if(isset($this->rules['nested_id'])) {
            return $this->rules['nested_id'];
        }
    }
}