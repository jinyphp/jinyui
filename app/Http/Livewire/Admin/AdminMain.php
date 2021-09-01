<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminMain extends Component
{
    public function render()
    {
        return view('livewire.admin.admin_main')->layout('layouts.admin');
    }
}
