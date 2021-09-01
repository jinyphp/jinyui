<?php
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;

class CSelect extends CTag {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var CSelectOption[]|CSelectOptionGroup[]  List of options and option groups.
	 */
	protected $options = [];

	/**
	 * @param string $name  Input field name.
	 */
	public function __construct(string $name) {
		parent::__construct('z-select', true);

		$this->name = $name;
	}

	/**
	 * 단일값 옵션
	 * @param CSelectOption $option
	 *
	 * @return self
	 */
	public function addOption(CSelectOption $option): self {
		$this->options[] = $option;

		return $this;
	}

	/**
	 * 배열 옵션
	 * @param CSelectOption[] $options
	 *
	 * @return self
	 */
	public function addOptions(array $options): self {
		foreach ($options as $option) {
			$this->addOption($option);
		}

		return $this;
	}

	/**
	 * @param CSelectOptionGroup $option_group
	 *
	 * @return self
	 */
	public function addOptionGroup(CSelectOptionGroup $option_group): self {
		$this->options[] = $option_group;

		return $this;
	}

	/**
	 * 선택되는 옵션값
	 * Selected option value. If no value is set, first available option will be preselected client at side.
	 *
	 * @param mixed $value
	 *
	 * @return self
	 */
	public function setValue($value): self {
		$this->setAttribute('value', $value);

		return $this;
	}

	/**
	 * Get ID for element that should be focused when focusing this component.
	 *
	 * @return string|null
	 */
	public function getFocusableElementId(): ?string {
		return $this->getAttribute('focusable-element-id');
	}

	/**
	 * ID for element that should be focused when focusing this component.
	 *
	 * @param string $id
	 *
	 * @return self
	 */
	public function setFocusableElementId(string $id): self {
		$this->setAttribute('focusable-element-id', $id);

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

	/**
	 * @param int $width
	 *
	 * @return self
	 */
	public function setWidth(int $width): self {
		$this->setAttribute('width', $width);

		return $this;
	}

	/**
	 * @return self
	 */
	public function setWidthAuto(): self {
		$this->setAttribute('width', 'auto');

		return $this;
	}

	/**
	 * @param int $value
	 *
	 * @return self
	 */
	public function setAdaptiveWidth(int $value): self {
		$this->addStyle('max-width: '.$value.'px;');

		return $this->setWidthAuto();
	}

	/**
	 * Set custom template for options.
	 *
	 * @param string $template
	 *
	 * @return self
	 */
	public function setOptionTemplate(string $template) {
		$this->setAttribute('option-template', $template);

		return $this;
	}

	/**
	 * @deprecated
	 *
	 * @param string $onchange
	 *
	 * @return self
	 */
	public function onChange($onchange) {
		/* hojin
		throw new RuntimeException(sprintf('Method is not implemented: "%s".', __METHOD__));
		*/
	}

	/**
	 * Convert values in associative array to options object collection.
	 *
	 * @static
	 *
	 * @param array $values
	 *
	 * @return CSelectOption[]
	 */
	public static function createOptionsFromArray(array $values): array {
		$options = [];

		foreach ($values as $value => $label) {
			$options[] = new CSelectOption($value, (string) $label);
		}

		return $options;
	}

	/**
	 * @return array
	 */
	public function toArray(): array {
		$options = [];

		foreach ($this->options as $option) {
			$options[] = $option->toArray();
		}

		return $options;
	}

	public function toString($destroy = true) {
		$this->setAttribute('name', $this->name);
		$this->setAttribute('data-options', json_encode($this->toArray()));

		/*
		 * This attribute makes element "focusable", it match by jQuery(':focusable') queries and also browser would be
		 * able to evaluate "autofocus" attribute correctly.
		 */
		$this->setAttribute('tabindex', '-1');

		return parent::toString($destroy);
	}
}
