<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;

trait Pagination 
{
    use WithPagination;

    public $totalPerPage;

    public function firstPage()
    {
        $this->setPage(1);
    }

    public function lastPage()
    {
        $this->setPage($this->totalPerPage);
    }
}