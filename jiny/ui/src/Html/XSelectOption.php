<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;
use Illuminate\Support\Facades\DB;

class XSelectOption extends CTag
{
    public function __construct($title = null) {
		parent::__construct("option", true, $title);
	}

    public function addSlot($slot)
    {
        $this->addItem($slot);
        return $this;
    }

    public function setValue($value)
    {
        $this->setAttribute("value",$value);
        return $this;
    }


}