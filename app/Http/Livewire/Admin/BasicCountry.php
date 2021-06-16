<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class BasicCountry extends Component
{
    public function render()
    {
        return view('livewire.admin.basic.country-form')->layout('layouts.admin');
    }
}
