<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DataTable extends Component
{
    public $title=[];
    public $rows=[];

    public function mount($title, $rows)
    {
        $this->title = $title;
        $this->rows = $rows;
    }

    public function render()
    {
        return view('livewire.data-table');
    }
}
