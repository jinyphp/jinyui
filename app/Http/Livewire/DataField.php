<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataField extends Component
{
    public $modalEditVisible = false;
    public $modalFieldEditVisible = false;
    public $mode = "list";
    public $_id;
    public $fields;

    public function modalClose()
    {
        $this->modalEditVisible = false;
    }

    public function fieldInsert()
    {

    }

    public function fieldEdit()
    {
        $this->modalFieldEditVisible = true;
    }

    public function fieldDelete()
    {

    }

    public function fieldList()
    {
        $this->modalEditVisible = true;
    }

    public function render()
    {
        $this->fields = DB::table("jiny_fields")->where('uri', "/admin/menu")->get(); 
        return view('livewire.data-field');
    }
}
