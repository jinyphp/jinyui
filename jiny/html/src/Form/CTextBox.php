<?php
/**
 * Html Object Component for Laravel from ZBX
 * Copyright GPL
 */
namespace Jiny\Html\Form;

class CTextBox extends CInput 
{

	private $caption;

	public function __construct($name = 'textbox', $value = '', $readonly = false, $maxlength = 255) {
		parent::__construct('text', $name, $value);
		$this->setReadonly($readonly);
		$this->caption = null;
		$this->setAttribute('maxlength', $maxlength);
	}

	public function setWidth($value) {
		$this->addStyle('width: '.$value.'px;');
		return $this;
	}

	public function setAdaptiveWidth($value) {
		$this->addStyle('max-width: '.$value.'px;');
		$this->addStyle('width: 100%;');
		return $this;
	}

		
	/**
	 * 추가: 가로폭 standard
	 *
	 * @return void
	 */
	public function setWidthStandard()
	{
		$this->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH);
		return $this;
	}


}
