<?php
namespace Jiny\Html\Form;

use Jiny\Html\Ctag;

/**
 * A class for rendering button elements.
 *
 * Should be used as a newer alternative to CButton.
 */
class CSimpleButton extends CTag
{

	public function __construct($caption = '') {
		parent::__construct('button', true, $caption);
		$this->setAttribute('type', 'button');
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
