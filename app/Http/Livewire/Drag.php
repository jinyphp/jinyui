<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Drag extends Component
{
    public $things =[
        ['id'=>1, 'title'=>"aaaa"],
        ['id'=>2, 'title'=>"bbbb"],
        ['id'=>3, 'title'=>"cccc"],
        ['id'=>4, 'title'=>"dddd"],
        ['id'=>5, 'title'=>"eeee"]
    ];

    public function reorder($orderIds)
    {
        //dd($orderIds);
        $this->things = collect($orderIds)->map(function($id){
            return collect($this->things)->where('id', (int)$id) ->first();
        })->toArray();
    }

    public function render()
    {
        return view('livewire.drag')->layout('layouts.admin');
    }
}
