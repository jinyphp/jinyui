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
}
