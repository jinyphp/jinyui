<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Data
{
    public $table;
    public $ids;
    public $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function setTable($table)
    {
        $this->table = $table;
        //return $this;
        return DB::table($this->table);
    }


    public function setIds($ids)
    {
        $this->ids = $ids;
        return $this;
    }

}