<?php
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CTextArea extends CTag {

	/**
	 * The "&" symbol in the textarea should be encoded.
	 *
	 * @var int
	 */
	protected $encStrategy = self::ENC_ALL;

	/**
	 * Init textarea.
	 *
	 * @param string	$name
	 * @param string	$value
	 * @param array		$options
	 * @param int		$options['rows']
	 * @param int		$options['maxlength']
	 * @param boolean	$options['readonly']
	 */
	public function __construct($name = 'textarea', $value = '', $options = []) {
		parent::__construct('textarea', true);
		$this->setId(zbx_formatDomId($name));
		$this->setAttribute('name', $name);
		$this->setAttribute('rows', !empty($options['rows']) ? $options['rows'] : ZBX_TEXTAREA_STANDARD_ROWS);
		if (isset($options['readonly'])) {
			$this->setReadonly($options['readonly']);
		}
		$this->addItem($value);

		// set maxlength
		if (!empty($options['maxlength'])) {
			$this->setMaxlength($options['maxlength']);
		}
	}




	public function setReadonly($value) {
		if ($value) {
			$this->setAttribute('readonly', 'readonly');
		}
		else {
			$this->removeAttribute('readonly');
		}
		return $this;
	}

	public function setValue($value = '') {
		$this->addItem($value);
		return $this;
	}

	public function setRows($value) {
		$this->setAttribute('rows', $value);
		return $this;
	}

	public function setCols($value) {
		$this->setAttribute('cols', $value);
		return $this;
	}

	public function setMaxlength($maxlength) {
		$this->setAttribute('maxlength', $maxlength);

		/*
		if (!defined('IS_TEXTAREA_MAXLENGTH_JS_INSERTED')) {
			define('IS_TEXTAREA_MAXLENGTH_JS_INSERTED', true);

			// firefox and google chrome have own implementations of maxlength validation on textarea
			insert_js('
				if (!CR && !GK) {
					jQuery("textarea[maxlength]").bind("paste contextmenu change keydown keypress keyup", function() {
						var elem = jQuery(this);
						if (elem.val().length > elem.attr("maxlength")) {
							elem.val(elem.val().substr(0, elem.attr("maxlength")));
						}
					});
				}',
			true);
			
		}
		*/
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

	public function setEnabled($value) {
		if ($value) {
			$this->removeAttribute('disabled');
		}
		else {
			$this->setAttribute('disabled', 'disabled');
		}
		return $this;
	}

	public function setPlaceholder($value)
	{
		$this->setAttribute('placeholder', $value);
		return $this;
	}
}
