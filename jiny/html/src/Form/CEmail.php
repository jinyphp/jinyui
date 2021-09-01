<?php
/**
 * Html Object Component for Laravel from ZBX
 * Copyright GPL
 */
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CEmail extends CTag {

	/**
	 * Enabled or disabled state of input field.
	 *
	 * @var bool
	 */
	protected $enabled = true;

	public function __construct($type = 'email', $name = 'textemail', $value = '') {
		parent::__construct('input');
		$this->setType($type);

		if ($name !== null) {
			$this->setId(zbx_formatDomId($name));
			$this->setAttribute('name', $name);
		}

		$this->setAttribute('value', $value);
		return $this;
	}

	public function setType($type) {
		$this->setAttribute('type', $type);
		return $this;
	}

	public function setReadonly($value) {
		if ($value) {
			$this->setAttribute('readonly', 'readonly');
			$this->setAttribute('tabindex', '-1');
		}
		else {
			$this->removeAttribute('readonly');
			$this->removeAttribute('tabindex');
		}
		return $this;
	}

	/**
	 * Prevent browser to autocomplete input element.
	 */
	public function disableAutocomplete() {
		$this->setAttribute('autocomplete', 'off');

		return $this;
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

	public function removeAttribute($name) {
		if ($name === 'disabled') {
			$this->enabled = false;
		}

		return parent::removeAttribute($name);
	}

	public function setAttribute($name, $value) {
		if ($name === 'disabled') {
			$this->enabled = ($value !== 'disabled');
		}

		return parent::setAttribute($name, $value);
	}

	/**
	 * 추가: 최대 입력허용 글자수 지정
	 *
	 * @return void
	 */
	public function setMaxLength($max)
	{
		$this->setAttribute('maxlength', $max);
		return $this;
	}

	public function setAutofocus()
	{
		$this->setAttribute('autofocus', 'autofocus');
		return $this;
	}

	/**
	 * 라이브와이어 속성
	 */
	public function setWireModel($pros)
	{
		$this->setAttribute('wire:model', $pros);
		return $this;
	}


}
