<?php

namespace Jiny\Html;

class CListItem extends CTag {

	public function __construct($value) {
		parent::__construct('li', true);
		$this->addItem($value);
	}
}
