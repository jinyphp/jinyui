<?php
namespace Jiny\Html\Table;
use \Jiny\Html\CTag;

class CRow extends CTag {

	protected $heading_column;

	/**
	 * @param CTag|array|null $item
	 * @param int|null $heading_column  Column index for heading column. Starts from 0. 'null' if no heading column.
	 */
	public function __construct($item = null, $heading_column = null) {
		parent::__construct('tr', true);		
		$this->addItem($item);
		$this->heading_column = $heading_column;
	}

	/**
	 * Add row content.
	 *
	 * @param CTag|array $item  Column tag, column data or array with them.
	 *
	 * @return CRow
	 */
	public function addItem($item) {
		// 컬럼이 한개인 경우
		if ($item instanceof CCol) {
			// td Object
			parent::addItem($item);
		}
		else
		// 복수개의 컬럼 처리
		if (is_array($item)) {
			
			foreach ($item as $el) {
				if ($el instanceof CCol) {
					// td Object
					parent::addItem($el);
				}
				elseif ($el !== null) {
					parent::addItem($this->createCell($el));
				}
			}
		}
		else
		if ($item !== null) {
			parent::addItem($this->createCell($item));
		}

		return $this;
	}

	/**
	 * Create cell (td or th tag) with given content.
	 *
	 * @param CTag|array $el  Cell content.
	 *
	 * @return CCol
	 */
	protected function createCell($el) {
		return ($this->heading_column !== null && $this->itemsCount() == $this->heading_column)
			? (new CColHeader($el))
			: (new CCol($el));
	}
}
