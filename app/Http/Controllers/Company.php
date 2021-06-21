<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Company extends TableController
{
    public function __construct()
    {
        $this->setRuleJson("jiny/menu.json");
        
    }
}
