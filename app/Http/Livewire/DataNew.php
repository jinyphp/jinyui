<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DataNew extends Component
{
    public $status = "ready";
    public function insert()
    {
        $this->status = "insert ok";
    }

    public function render()
    {
        return view('livewire.data-new');
    }
}
