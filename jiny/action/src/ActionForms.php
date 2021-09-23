<?php
namespace Jiny\Action;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Jiny\Html\CTag;

class ActionForms
{
    public $rules = [];
    public $rows = [];

    public function __construct($rules, $data=[])
    {
        $this->rules = $rules;
        $this->rows = $data;
    }

    public function build()
    {
        $form = new CTag('div', true);
        foreach ($this->rules['fields'] as $item) {
            if($item['form']) {
                $form->addItem($item['title']);

                $input = $this->parser($item);
                $form->addItem($input);
                
            }
        }
        
        return $form;
    }

    public function parser($item)
    {
        if($item['input'] == "text" || 
                    $item['input'] == "email" ||
                    $item['input'] == "number" ||
                    $item['input'] == "hidden") {
                    
            $input = xInput($item['input'], $item['name']);
            return $input;

        } else 
        if ($item['input'] == "textarea") {
            return xTextarea($item['name']);
        } else if ($item['input'] == "checkbox") {
            return xCheckbox($item['name']);
        } else if ($item['input'] == "radio") {
            
        } else if ($item['input'] == "select") {

        } else {

        }
    }
}