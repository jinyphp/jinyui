<?php
namespace Jiny\Html\Table;

class CRowHeader extends CRow {

	/**
	 * Create cell (th tag) with given content.
	 *
	 * @param CTag|array $item  Cell content.
	 *
	 * @return CCol
	 */
	protected function createCell($item) {
		return (new CColHeader($item));
	}
}
