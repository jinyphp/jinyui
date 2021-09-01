<?php
namespace Jiny\Html\Table;
use \Jiny\Html\CTag;

class CCol extends CTag {

	public function __construct($item = null) {
		parent::__construct('td', true);
		$this->addItem($item);
	}

	public function setRowSpan($value) {
		$this->setAttribute('rowspan', $value);
		return $this;
	}

	public function setColSpan($value) {
		$this->setAttribute('colspan', $value);
		return $this;
	}

	public function setWidth($value) {
		$this->setAttribute('width', $value);

		return $this;
	}
}
