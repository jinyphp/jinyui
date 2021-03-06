<?php
namespace Jiny\Html;


/**
 * Class to create a date textbox and calendar button.
 */
class CDateSelector extends CTag {
	/**
	 * Default CSS class name for HTML root element.
	 */
	const ZBX_STYLE_CLASS = 'calendar-control';

	/**
	 * Default date format.
	 *
	 * @var string
	 */
	private $date_format = ZBX_FULL_DATE_TIME;

	/**
	 * Set aria-required to textbox.
	 *
	 * @var bool
	 */
	private $is_required = false;

	/**
	 * Placeholder for date textbox field.
	 *
	 * @var string
	 */
	private $placeholder = null;

	/**
	 * Date and time set from view. Absolute (Y-m-d H:i:s) or relative time (now+1d, now/M ...).
	 *
	 * @var string
	 */
	private $value = null;

	/**
	 * Readonly state of HTML element.
	 *
	 * @var bool
	 */
	private $readonly = false;

	/**
	 * Enabled or disabled state of HTML element.
	 *
	 * @var bool
	 */
	private $enabled = true;

	/**
	 * Create array with all inputs required for date selection and calendar.
	 *
	 * @param string $name   Textbox field name and calendar name prefix.
	 * @param string $value  Date and time set from view. Absolute (Y-m-d H:i:s) or relative time (now+1d, now/M ...).
	 *
	 * @return CDateSelector
	 */
	public function __construct($name = 'calendar', $value = null) {
		parent::__construct('div', true);

		$this->name = $name;
		$this->value = $value;
		$this->addClass(static::ZBX_STYLE_CLASS);
	}

	/**
	 * Set or reset element 'aria-required' attribute to textbox (not the container).
	 *
	 * @param bool $is_required  True to set field as required or false if field is not required.
	 *
	 * @return CDateSelector
	 */
	public function setAriaRequired($is_required = false) {
		$this->is_required = $is_required;

		return $this;
	}

	/**
	 * Set date format which calendar will return upon selection.
	 *
	 * @param string $format  Date and time format. Usually Y-m-d H:i:s or Y-m-d H:i
	 *
	 * @return CDateSelector
	 */
	public function setDateFormat($format) {
		$this->date_format = $format;

		return $this;
	}

	/**
	 * Add placeholder to date textbox field.
	 *
	 * @param type $text  Placeholder text for date textbox field.
	 *
	 * @return CDateSelector
	 */
	public function setPlaceholder($text) {
		$this->placeholder = $text;

		return $this;
	}

	/**
	 * Enable or disable readonly mode for the element.
	 *
	 * @param bool $value
	 *
	 * @return self
	 */
	public function setReadonly(bool $value): self {
		$this->readonly = $value;

		return $this;
	}

	/**
	 * Set enabled or disabled  state to field.
	 *
	 * @param bool $enabled  Field state.
	 *
	 * @return CDateSelector
	 */
	public function setEnabled($enabled) {
		$this->enabled = $enabled;

		return $this;
	}

	/**
	 * Gets string representation of date textbox and calendar button.
	 *
	 * @param bool $destroy
	 *
	 * @return string
	 */
	public function toString($destroy = true) {
		$this
			->addItem(
				(new CTextBox($this->name, $this->value))
					->setId($this->name)
					->setAttribute('placeholder', $this->placeholder)
					->setAttribute('maxlength', strlen(date($this->date_format)))
					->setAriaRequired($this->is_required)
					->setEnabled($this->enabled)
					->setReadonly($this->readonly)
			)
			->addItem((new CButton($this->name.'_calendar'))
				->addClass(ZBX_STYLE_ICON_CAL)
				->setEnabled($this->enabled && !$this->readonly)
				->onClick('toggleCalendar(this, "'.$this->name.'", "'.$this->date_format.'");'));

		return parent::toString($destroy);
	}
}
