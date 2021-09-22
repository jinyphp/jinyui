<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XTableCheckRow extends CTag
{
    public function __construct($i) {
		parent::__construct('div', true);
        
        $this->addClass("form-check"); //bootstrap css
        $this->addItem($this->input($i));
        $this->addItem($this->label($i));

    }

    private function input($i)
    {
        $input = (new \Jiny\Html\CTag("input",true));
        $input->setAttribute("type", "checkbox");
        $input->setAttribute("id", "ids_".$i);
        $input->setAttribute("name", "ids");
        $input->setAttribute("value", $i);
        $input->addClass("form-check-input rowCheckbox");

        return $input;
    }

    private function label($i)
    {
        $label = (new \Jiny\Html\CTag("label",true));
        $label->setAttribute("for", "ids_".$i);
        $label->addClass("form-check-label");
        $label->addHtml("&nbsp;");

        return $label;
    }

}