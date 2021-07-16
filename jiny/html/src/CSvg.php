<?php
namespace Jiny\Html;

class CSvg extends CTag {

	public function __construct($items = null) {
		parent::__construct('svg', true); // CTag
		//$this->addItem($items);
	}
	
}
