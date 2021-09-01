<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteMenu extends Controller
{
    public function __construct()
    {
        $fields = $this->get_field_json("rules/mmm.json");    
    }

    public function get_field_json($filename)
    {
        $path = resource_path($filename);
        // dd($path);
        $json = file_get_contents($path);
        //dd($json);
        return json_decode($json,true);
    }


}
