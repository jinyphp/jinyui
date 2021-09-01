<?php
namespace Jiny\Html;

class CDiv extends CTag 
{

	public function __construct($items = null) {
		parent::__construct('div', true); // CTag
		$this->addItem($items);
	}

	/**
	 * 가로폭 지정
	 *
	 * @param  mixed $value
	 * @param  mixed $unit : 지정단위, 기본값 px
	 * @return void
	 */
	public function setWidth($value, $unit="px") {
		$this->addStyle('width: '.$value.$unit.';');
		return $this;
	}

	/**
	 * 가로폭 지정(반응형)
	 *
	 * @param  mixed $value
     * @param  mixed $unit : 지정단위, 기본값 px
	 * @return void
	 */
	public function setAdaptiveWidth($value, $unit="px") {
		$this->addStyle('max-width: '.$value.$unit.'px;');
		$this->addStyle('width: 100%;');
		return $this;
	}
}
