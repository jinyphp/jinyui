<?php

namespace Jiny\Html;

class CButton extends CTag  {

	public function __construct($name = 'button', $caption = '') {
		parent::__construct('button', true, $caption);
		$this->setAttribute('type', 'button');

		if ($name !== null) {
			$this->setId(zbx_formatDomId($name));
			$this->setAttribute('name', $name);
		}
	}

	/**
	 * Enable or disable the element.
	 *
	 * @param bool $value
	 */
	public function setEnabled($value) {
		if ($value) {
			$this->removeAttribute('disabled');
		}
		else {
			$this->setAttribute('disabled', 'disabled');
		}
		return $this;
	}
}
