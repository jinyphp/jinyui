<?php
namespace Jiny\Html;

use Jiny\Html\Form\CInput;
use Jiny\Html\Form\CTextArea;

class CVar {

	public $var_container;
	public $var_name;
	public $element_id;

	public function __construct($name, $value = null, $id = null) {
		$this->var_container = [];
		$this->var_name = $name;
		$this->element_id = $id;
		$this->setValue($value);
	}

	public function setValue($value) {
		$this->var_container = [];
		if ($value !== null) {
			$this->parseValue($this->var_name, $value);
		}
		return $this;
	}

	private function parseValue($name, $value) {
		if (is_array($value)) {
			foreach ($value as $key => $item) {
				if (is_null($item)) {
					continue;
				}
				$this->parseValue($name.'['.$key.']', $item);
			}
			return null;
		}
		if (strpos($value, "\n") === false) {
			$hiddenVar = new CInput('hidden', $name, $value);

			if ($this->element_id !== null) {
				$hiddenVar->setId($this->element_id);
			}
		}
		else {
			$hiddenVar = (new CTextArea($name, $value))->addStyle('display: none;');
		}
		$this->var_container[] = $hiddenVar;
	}

	public function toString() {
		$res = '';
		foreach ($this->var_container as $item) {
			$res .= $item->toString();
		}

		return $res;
	}

	/**
	 * Remove ID attribute from tag.
	 *
	 * @return CVar
	 */
	public function removeId() {
		foreach ($this->var_container as $item) {
			$item->removeAttribute('id');
		}

		return $this;
	}

	/**
	 * Enable or disable the element.
	 *
	 * @param bool $value
	 *
	 * @return CVar
	 */
	public function setEnabled($value) {
		foreach ($this->var_container as $item) {
			$item->setEnabled($value);
		}

		return $this;
	}
}
