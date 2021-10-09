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

    public function formItems()
    {
        $formItems = [];
        foreach ($this->rules['fields'] as $item) {
            if($item['form']) {
                $input = $this->parser($item);
                $formItem = xFormItem()
                    ->setLabel($item['title'])
                    ->setItem($input)
                    ->horizontal()
                    ->addClass('mb-3');
                
                $formItems []= $formItem;                
            }
        }
        return $formItems;
    }

    public function build()
    {
        $form = new CTag('div', true);
        foreach ($this->formItems() as $item) {
            $form->addItem($item);
        }
        
        return $form;
    }

    public function parser($item)
    {
        if($item['input'] == "text" || 
                    $item['input'] == "email" ||
                    $item['input'] == "number" ||
                    $item['input'] == "hidden") {
                    
            $input = xInput($item['input'], $item['name'])
                ->setAttribute('wire:model.defer',"_data.".$item['name']);
            return $input;

        } else 
        if ($item['input'] == "password") {
            $input = xInput('password', $item['name'])
                ->setAttribute('wire:model.defer',"_data.".$item['name']);
            return $input;
        } else 
        if ($item['input'] == "textarea") {
            return xTextarea($item['name'])
                ->setAttribute('wire:model.defer',"_data.".$item['name']);

        } else if ($item['input'] == "checkbox") {
            return xCheckbox($item['name'])
            ->setAttribute('wire:model.defer',"_data.".$item['name']);

        } else if ($item['input'] == "radio") {
            
        } else if ($item['input'] == "select") {

        } else {

        }
    }
}