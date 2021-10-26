<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;


class XProgress extends CTag
{
    private $now;
    private $max;
    private $min;


    public function __construct($now=0, $max=100, $min=0) 
    {
		parent::__construct('div', true);
        $this->addClass("progress mb-3");

        $this->now = $now;
        $this->max = $max;
        $this->min = $min;

	}

    private $label = false;
    public function setLabel()
    {
        $this->label = true;
        return $this;
    }

    private $height = 16;
    public function setHeight($value)
    {
        $this->height = $value;
        return $this;
    }

    private $color;
    public function setColor($value)
    {
        $this->color = $value;
        return $this;
    }

    public function toString($destroy = true) 
    {
        $item = new CTag("div", true);
        $item->addClass("progress-bar");
        $item->setAttribute("role","progressbar");

        if($this->now) {
            $item->setAttribute("style", "width:".$this->now."%");
        }        
        $item->setAttribute("aria-valuenow", $this->now);
        $item->setAttribute("aria-valuemin", $this->min);
        $item->setAttribute("aria-valuemax", $this->max);


        if($this->label) {
            $item->addItem($this->now."%");
        }


        if($this->height) {
            $this->addStyle("height:".$this->height."px;");
        }


        if($this->color) {
            $item->addClass($this->color);
        }


        $this->addItem($item);

        
        return parent::toString($destroy);
    }
    




}