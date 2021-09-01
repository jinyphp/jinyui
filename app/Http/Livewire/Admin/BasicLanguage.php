<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class BasicLanguage extends Component
{

    public $modalFormVisible = false;
    public $code = "1234";
    /**
     * createShowModal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->modalFormVisible = true;
        $this->code = "abcde";
    }

    public function removeModal()
    {
        $this->modalFormVisible = false;
    }
    
    /**
     * 새로운 국가를 추가합니다.
     *
     * @return void
     */
    public function create()
    {
        $this->removeModal();
    }
    
    public function render()
    {
        return view('livewire.admin.basic-language')->layout('layouts.admin');
    }
}
