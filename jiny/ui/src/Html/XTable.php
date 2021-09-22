<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XTable extends CTag
{
    public function __construct($slot) {
		parent::__construct('table', true);
        $this->addHtml($slot);

        $this->addClass('table'); // bootstrap css
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