<?php
namespace Jiny\Html\Form;


/**
 * A structure used by CSelect that describes a single option of select element.
 */
class CSelectOption {

	/**
	 * @var string
	 */
	protected $label;

	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * Arbitrary data associated with this option.
	 *
	 * @var array
	 */
	protected $extra = [];

	/**
	 * @var array
	 */
	protected $class_names = [];

	/**
	 * @var bool
	 */
	protected $disabled = false;

	/**
	 * @param mixed  $value  Option value.
	 * @param string $label  Option name.
	 */
	public function __construct($value, string $label) {
		$this->value = $value;
		$this->label = $label;
	}

	/**
	 * Add arbitrary data associated with this option.
	 *
	 * @param string $key
	 * @param string $value
	 *
	 * @return self
	 */
	public function setExtra(string $key, string $value): self {
		$this->extra[$key] = $value;

		return $this;
	}

	/**
	 * @param bool $value
	 *
	 * @return self
	 */
	public function setDisabled(bool $value = true): self {
		$this->disabled = $value;

		return $this;
	}

	/**
	 * @param string $class_name
	 *
	 * @return self
	 */
	public function addClass(?string $class_name): self {
		if ($class_name) {
			$this->class_names[] = $class_name;
		}

		return $this;
	}

	/**
	 * Formats this object into associative array.
	 *
	 * @return array
	 */
	public function toArray(): array {
		$option = [
			'value' => $this->value,
			'label' => $this->label
		];

		if ($this->extra) {
			$option['extra'] = $this->extra;
		}

		if ($this->class_names) {
			$option['class_name'] = implode(' ', $this->class_names);
		}

		if ($this->disabled) {
			$option['is_disabled'] = true;
		}

		
		return $option;
	}
}
