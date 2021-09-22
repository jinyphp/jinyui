<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Jiny\Action\Http\Livewire\LiveData;
use Jiny\Action\Http\Livewire\LiveTable;
class LiveField extends LiveTable
{

    protected function selectDataRows()
    {
        if (isset($this->rules['tablename'])) {
            $db = DB::table($this->rules['tablename']);

            if($this->nested) {
                $nested_field = $this->rules['nested']['tablename']."_id";
                //dd($this->rules['nested']['tablename']);
                $db->where($nested_field,$this->nested);
            }

            $datas = $db->orderBy('id',"desc")
                    ->paginate(10);
            return $datas;
        }
    
        return [];
    }


}
