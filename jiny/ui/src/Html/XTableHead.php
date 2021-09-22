<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XTableHead extends CTag
{
    public function __construct($slot=null) {
		parent::__construct('thead', true);

        if ($slot) {
            $this->addHtml($slot);
        }        
    }

    public function setAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {           
            foreach($attrs as $name => $value) {
                if ($name === "class") {
                    $this->addClass($value);
                    continue;
                }
                $this->setAttribute($name, $value);
            }
        }
        return $this;
    }





}