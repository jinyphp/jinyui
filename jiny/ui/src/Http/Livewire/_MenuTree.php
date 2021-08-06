<?php

namespace Jiny\UI\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\View;
use Jiny\UI\View\Components\Icon;

class MenuTree extends Component
{
    
    public $content, $before, $after;
    public $admin = true;

    public $filename;
    public $json;

    public function mount()
    {
        /*
        $this->json = new \Jiny\UI\Json();
        $this->json->setFilename($this->filename);
        $this->json->set($this->menu);
        */
    }


    





    















    /**
     * 
     */

    public function sort()
    {
        
    }

    // modal popup

    public $modalEditMenuAdmin = false;
    public $_data;
    public function edit($id)
    {
        $this->modalEditMenuAdmin = true;
        $this->_data = $this->findId($id, $this->menu);
        
    }

    public function update()
    {
        $this->modalEditMenuAdmin = false;
    }

    public function findId($id, $menu)
    {
        foreach($menu as $value) {
            if($id == $value['id']) return $value;
            if(isset($value['submenu'])) {
                $item = $this->findId($id, $value['submenu']);
                if(isset($item['id']) && $item['id'] == $id) return $item;
            }
        }
    }




}
