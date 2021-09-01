<?php

namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CLabel extends CTag {

	public function __construct($label, $for = null) {
		parent::__construct('label', true, $label);

		if ($for !== null) {
			$this->setAttribute('for', zbx_formatDomId($for));
		}
	}

	/**
	 * Allow to add visual 'asterisk' mark to label.
	 *
	 * @param bool $add_asterisk  Define is label marked with asterisk or not.
	 *
	 * @return CLabel
	 */
	public function setAsteriskMark($add_asterisk = true) {
		return $this->addClass($add_asterisk ? 'form-label-asterisk': null);
	}
}
