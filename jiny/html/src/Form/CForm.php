<?php
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;
use \Jiny\Html\CVar;
use \Jiny\Html\CDiv;

class CForm extends CTag {

	public function __construct($method = 'post', $action = null, $enctype = null) {
		parent::__construct('form', true);
		$this->setMethod($method);
		$this->setAction($action);
		$this->setEnctype($enctype);
		$this->setAttribute('accept-charset', 'utf-8');

        /*
        hojin
		$this->addVar('sid', substr(CSessionHelper::getId(), 16, 16));

		$this->addVar('form_refresh', getRequest('form_refresh', 0) + 1);
        */
	}

	public function setMethod($value = 'post') {
		$this->attributes['method'] = $value;
		return $this;
	}

	public function setAction($value) {
		global $page;

		if (is_null($value)) {
			$value = isset($page['file']) ? $page['file'] : 'zabbix.php';
		}
		$this->attributes['action'] = $value;
		return $this;
	}

	public function setEnctype($value = null) {
		if (is_null($value)) {
			$this->removeAttribute('enctype');
		}
		else {
			$this->setAttribute('enctype', $value);
		}
		return $this;
	}

	public function addVar($name, $value, $id = null) {
		if (!is_null($value)) {

			$this->addItem(new CVar($name, $value, $id));

		}
		return $this;
	}

	/**
	 * Prevent browser from auto fill inputs with type password.
	 *
	 * @return CForm
	 */
	public function disablePasswordAutofill() {
		$this->addItem((new CDiv([
			(new CInput('password', null, null))->setAttribute('tabindex', '-1')->removeId()
		]))->addStyle('display: none;'));

		return $this;
	}


	private $layout;	
	/**
	 * 폼요소 출력 레이아웃
	 * basic,horizontal, row, inline
	 *
	 * @param  mixed $layout
	 * @return void
	 */
	public function setLayout($layout="basic")
	{	
		$this->layout = $layout;
		return $this;
	}

		
	/**
	 * 레이아웃 형식에 맞추어 항목을 추가
	 *
	 * @param  mixed $value
	 * @return void
	 */
	public function addList($value)
	{
		if($this->layout == "basic") {
			$item = CDiv($value)->addClass("mb-3");
		} else 
		if($this->layout == "horizontal") {
			$item = CDiv(
				[
					CDiv($value[0])->addClass("col-sm-2")->addClass("text-sm-end"),
					CDiv($value[1])->addClass("col-sm-10")
				]
			)->addClass("mb-3")->addClass("row");
		}
		else {
			$item = $value;
		}
		
		$this->addItem($item);
		return $this;
	}
}
