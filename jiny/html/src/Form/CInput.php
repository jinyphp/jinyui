<?php
/**
 * Html Object Component for Laravel from ZBX
 * Copyright GPL
 */
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CInput extends CTag {

	/**
	 * Enabled or disabled state of input field.
	 *
	 * @var bool
	 */
	protected $enabled = true;


	// 객체 생성
	public function __construct($type = 'text', $name = null, $value = null) {
		parent::__construct('input');
		$this->setType($type);

		if ($name !== null) {
			$this->setId(zbx_formatDomId($name));
			$this->setAttribute('name', $name);
		}

		$this->setAttribute('value', $value);
		return $this;
	}


	// 타입지정
	public function setType($type) {
		$this->setAttribute('type', $type);
		return $this;
	}


	// 읽기 전용 설정
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


	public function setDisable() {
		$this->setAttribute('disabled', 'disabled');
		return $this;
	}


	// overriding
	// 속성제거
	public function removeAttribute($name) {
		if ($name === 'disabled') {
			$this->enabled = false;
		}

		return parent::removeAttribute($name);
	}


	// overriding
	// 속성설정
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


	public function setPlaceholder($value)
	{
		$this->setAttribute('placeholder', $value);
		return $this;
	}

	public function setValue($value) {
		$this->setAttribute('value', $value);
		return $this;
	}


}
