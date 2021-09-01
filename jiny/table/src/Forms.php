<?php 
namespace Jiny\Table;



class Forms
{
    public function input($item)
    {
        if ($item['form']) {
            if($item['input'] == "checkbox") {

            } else 
            if($item['input'] == "radio") {

            } else 
            if($item['input'] == "textarea") {
                $input = xTextArea();
            } else 
            if($item['input'] == "link") {

            } else {
                $input = xInput($item['input']);
            }

            if(isset($item['form_width'])) {
                $input->setWidth($item['form_width']);
            } else {
                $input->setWidth("standard");
            }

            // livewire
            $input->setAttribute("wire:model.defer","_data.".$item['name']);

            return $input;
        }  
    }
}