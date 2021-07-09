<?php
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CSelect extends CTag {

	/**
	 * @var string
	 */
	protected $name;
	protected $value;
	protected $options = [];


	/**
	 * Select 테그 생성
	 * @param string $name
	 */
	public function __construct(string $name, $value=null) {
		parent::__construct('select', true);
		$this->name = $name;
		$this->value = $value;
	}

	public function setValue($value): self 
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @param bool $value
	 *
	 * @return self
	 */
	public function setDisabled(bool $value = true): self {
		if ($value) {
			$this->setAttribute('disabled', 'disabled');
		}
		else {
			$this->removeAttribute('disabled');
		}

		return $this;
	}

	/**
	 * Enable or disable readonly mode for the element.
	 *
	 * @param bool $value
	 *
	 * @return self
	 */
	public function setReadonly(bool $value = true): self {
		if ($value) {
			$this->setAttribute('readonly', 'readonly');
		}
		else {
			$this->removeAttribute('readonly');
		}

		return $this;
	}

	/**
	 * @param string|null $name
	 *
	 * @return self
	 */
	public function setName($name): self {
		$this->name = $name;
		return $this;
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


	public function addOption($label,$value=null): self 
	{
		$opt = new CTag('option', true, $label);
		if ($value) {
			$opt->setAttribute('value', $value);
			if($this->value == $value) $opt->setAttribute('selected',"");
		}		
		$this->addItem($opt);
		return $this;
	}


	public function addOptions(array $options): self {
		foreach ($options as $value => $label) {
			$this->addOption($label,$value);
		}
		return $this;
	}



	public function onChange($onchange) {

	}

	/**
	 * 객체 출력 처리 부분
	 */

	public function toString($destroy = true) {
		$this->setAttribute('name', $this->name);
		return parent::toString($destroy);
	}
}
