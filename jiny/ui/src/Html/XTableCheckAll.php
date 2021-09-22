<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XTableCheckAll extends CTag
{
    public function __construct() {
		parent::__construct('div', true);
        
        $this->addClass("form-check"); //bootstrap css
        $this->addItem($this->input());
        $this->addItem($this->label());

    }

    private function input()
    {
        $obj = (new \Jiny\Html\CTag("input",true));
        $obj->setAttribute("type", "checkbox");
        $obj->setAttribute("id", "all_checks");
        $obj->setAttribute("name", "all_checks");
        $obj->addClass("form-check-input");
        return $obj;    
    }

    private function label()
    {
        $obj = (new \Jiny\Html\CTag("label",true));
        $obj->setAttribute("for", "all_checks");
        $obj->addClass("form-check-label");
        $obj->addHtml("&nbsp;");
        return $obj;
    }

}