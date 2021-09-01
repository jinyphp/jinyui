<?php
namespace Jiny\Html\Form;

use Jiny\Html\CList;
use Jiny\Html\CListItem;
use Jiny\Html\CSpan;
use Jiny\Html\CVar;


class CRadioButtonList extends CList 
{

	/**
	 * Default CSS class name for HTML root element.
	 */
	const STYLE_CLASS = 'radio-list-control';

	const ORIENTATION_HORIZONTAL = 'horizontal';
	const ORIENTATION_VERTICAL = 'vertical';

	private $name;
	private $value;
	private $orientation;
	private $enabled;
	private $readonly;
	private $modern;
	private $autofocused;

	/**
	 * Array of value elements.
	 *
	 * string $values[]['name']       Input form element label.
	 * string $values[]['value']      Input form element value.
	 * string $values[]['id']         Input form element id attribute.
	 * string $values[]['on_change']  Javascript handler for onchange event.
	 * @property array
	 */
	protected $values = [];

	public function __construct($name, $value) {
		parent::__construct();

		$this->name = $name;
		$this->value = $value;
		$this->orientation = self::ORIENTATION_HORIZONTAL;
		$this->enabled = true;
		$this->values = [];
		$this->modern = false;
		$this->readonly = false;
		$this->setId(zbx_formatDomId($name));
	}

	/**
	 * Add value.
	 *
	 * @param string $name       Input element label.
	 * @param string $value      Input element value.
	 * @param string $id         Input element id.
	 * @param string $on_change  Javascript handler for onchange event.
	 *
	 * @return CRadioButtonList
	 */
	public function addValue($name, $value, $id = null, $on_change = null) {
		$this->values[] = [
			'name' => $name,
			'value' => $value,
			'id' => ($id === null ? null : zbx_formatDomId($id)),
			'on_change' => $on_change
		];

		return $this;
	}

		
	/**
	 * 세로배치
	 * list-check-radio 만 적용가능
	 *
	 * @return void
	 */
	public function makeVertical() {
		$this->orientation = self::ORIENTATION_VERTICAL;
		return $this;
	}

	public function setEnabled($enabled) {
		$this->enabled = $enabled;
		return $this;
	}

	public function setReadonly($readonly) {
		$this->readonly = $readonly;
		return $this;
	}

	public function setModern($modern) {
		$this->modern = $modern;
		return $this;
	}

	public function toString($destroy = true) {
		if ($this->modern) {
			// radio-list-control 스타일
			$this->addClass('radio-list-control');
		}
		else {
			// 'list-check-radio'
			$this->addClass('list-check-radio');
			$this->addClass($this->orientation === self::ORIENTATION_HORIZONTAL ? 'hor-list' : null); // 'hor-list'
		}

		if ($this->readonly) {
			$this->addItem(
				(new CVar($this->name, $this->value))
					->setEnabled($this->enabled)
					->removeId()
			);
		}

		foreach ($this->values as $key => $value) {
			if ($value['id'] === null) {
				$value['id'] = zbx_formatDomId($this->name).'_'.$key;
			}

			$radio = (new CInput('radio', $this->name, $value['value']))
				// Read-only for radioboxes is simulated by disabling control and adding CVar with value.
				->setEnabled($this->enabled && !$this->readonly)
				->onChange($value['on_change'])
				->setId($value['id']);

			// 선택
			if ($value['value'] === $this->value) {
				$radio->setAttribute('checked', 'checked');

				if ($this->autofocused) {
					$radio->setAttribute('autofocus', 'autofocus');
				}
			}

			if ($this->modern) {
				$this->addItem((new CListItem([$radio, new CLabel($value['name'], $value['id'])]))->addClass(
					array_key_exists('class', $value) ? $value['class'] : null
				));
			}
			else {
				$radio->addClass(ZBX_STYLE_CHECKBOX_RADIO);
				$this->addItem((new CListItem([$radio, new CLabel([new CSpan(), $value['name']], $value['id'])]))
					->addClass(array_key_exists('class', $value) ? $value['class'] : null)
				);
			}
		}

		if ($this->getAttribute('aria-required') === 'true') {
			$this->setAttribute('role', 'radiogroup');
		}

		return parent::toString($destroy);
	}

	/**
	 * Overrides base method to correctly handle autofocus attribute for radio buttons.
	 *
	 * @param $name
	 * @param $value
	 *
	 * @return CRadioButtonList
	 */
	public function setAttribute($name, $value) {
		if ($name === 'autofocus') {
			$this->autofocused = true;
			return $this;
		}

		return parent::setAttribute($name, $value);
	}
}
