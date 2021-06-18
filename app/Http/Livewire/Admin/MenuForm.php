<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class MenuForm extends Component
{
    public $title;
    public $mode;

    public $_id;
    public $_enable;
    public $_code;
    public $_title;
    public $_uri;
    public $_target;
    public $_description;

    public function render()
    {
        return view('livewire.admin.menu-form');
    }
}
