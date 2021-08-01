<?php

namespace Jiny\UI\View\Components;

use Illuminate\View\Component;
/**
 * json menu tree 생성
 */
class Menu extends Component
{
    public $jsondata = [];
    public $filename;
    public function __construct($json=null)
    {
        $path = resource_path($json);
        $json = file_get_contents($path);
        $jsondata = json_decode($json,true);

        $this->jsondata = $jsondata;
        $this->filename = $json;
    }

    /*
    public function getData()
    {
        return $this->jsondata;
    }

    public function setData($data)
    {
        $this->jsondata = $data;
        return $this;
    }
    */


    public function render()
    {   
        // Livewire menu-tree 호출...
        //return view('jinyui::components.sidebar.menu');
        return <<<'blade'
        <div {{ $attributes }}>
            @livewire('menu-tree',['menu'=>$jsondata, 'content'=>$slot->toHtml(), 'filename'=>$filename]) 
        </div>
    blade;
    }
}
