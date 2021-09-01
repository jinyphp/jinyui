<?php

namespace Jiny\Html;

class CList extends CTag {

	private $emptyList;

	/**
	 * Creates a UL list.
	 *
	 * @param array $values			an array of items to add to the list
	 */
	public function __construct(array $values = []) {
		parent::__construct('ul', true);

		foreach ($values as $value) {
			$this->addItem($value);
		}

		if (!$values) {
			$this->addItem(__('List is empty'), 'empty');
			$this->emptyList = true;
		}
	}


	private function prepareItem($value = null, $class = null, $id = null) {
		if ($value !== null) {
			$value = new CListItem($value);
			if ($class !== null) {
				$value->addClass($class);
			}
			if ($id !== null) {
				$value->setId($id);
			}
		}

		return $value;
	}

	
	public function addItem($value, $class = null, $id = null) {
		if (!is_null($value) && $this->emptyList) {
			$this->emptyList = false;
			$this->items = [];
		}

		if ($value instanceof CListItem) {
			parent::addItem($value);
		}
		else {
			parent::addItem($this->prepareItem($value, $class, $id));
		}

		return $this;
	}

}
