<?php
namespace Jiny\Html\Form;

/**
 * A button used for submitting a form.
 */
class CSubmitButton extends CSimpleButton {

	/**
	 * @param string $caption
	 * @param string $name
	 * @param string $value
	 * @param string $class
	 */
	public function __construct($caption, $name = null, $value = null) {
		parent::__construct($caption);
		$this->setAttribute('type', 'submit');

		if ($name !== null) {
			$this->setAttribute('name', $name);
		}
		if ($value !== null) {
			$this->setAttribute('value', $value);
		}
	}
}
