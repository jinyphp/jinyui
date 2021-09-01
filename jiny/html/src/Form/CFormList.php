<?php
namespace Jiny\Html\Form;

use \Jiny\Html\CList;
use \Jiny\Html\CDiv;
use \Jiny\Html\CVar;

class CFormList extends CList {

	protected $editable = true;
	protected $formInputs = ['ctextbox', 'cnumericbox', 'ctextarea', 'ccheckbox', 'cpassbox'];

	public function __construct($id = null) {
		parent::__construct();

		$this->addClass(ZBX_STYLE_TABLE_FORMS);

		if ($id) {
			$this->setId(zbx_formatDomId($id));
		}
	}

	public function addRow($term, $description = null, $id = null, $class = null) {
		$input_id = null;

		$input = $description;
		if (is_array($input)) {
			$input = reset($input);
		}

		if (is_object($input)) {
			$input_class = strtolower(get_class($input));

			if (in_array($input_class, $this->formInputs)) {
				if ($input_class !== 'ccheckbox' || $input->getLabel() === '') {
					$input_id = $input->getAttribute('id');
				}
			}
		}

		$label = is_object($term) ? $term : new CLabel($term, $input_id);

		if ($description === null) {
			$this->addItem([
				(new CDiv(SPACE))->addClass(ZBX_STYLE_TABLE_FORMS_TD_LEFT),
				(new CDiv($label))->addClass(ZBX_STYLE_TABLE_FORMS_TD_RIGHT)],
				$class, $id);
		}
		else {
			$this->addItem([
				(new CDiv($label))->addClass(ZBX_STYLE_TABLE_FORMS_TD_LEFT),
				(new CDiv($description))->addClass(ZBX_STYLE_TABLE_FORMS_TD_RIGHT)],
				$class, $id);
		}

		return $this;
	}

	public function addInfo($text) {
		$this->addItem(
			[
				(new CDiv())->addClass(ZBX_STYLE_TABLE_FORMS_TD_LEFT),
				(new CDiv(
					(new CDiv($text))->addClass(ZBX_STYLE_TABLE_FORMS_SEPARATOR)
				))->addClass(ZBX_STYLE_TABLE_FORMS_TD_RIGHT)
			]
		);
		return $this;
	}

	public function toString($destroy = true) {
		return parent::toString($destroy);
	}

	public function addVar($name, $value, $id = null) {
		if ($value !== null) {
			$this->addItem(new CVar($name, $value, $id));
		}
		return $this;
	}
}
