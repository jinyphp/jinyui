{!! (new \Jiny\Html\Table\CTableInfo())
	->setHeader([
        (new \Jiny\Html\Table\CColHeader(
			(new \Jiny\Html\Form\CCheckBox('all_users'))
		))->addClass(ZBX_STYLE_CELL_WIDTH),
		__('Members'),
		__('Frontend access'),
		__('Debug mode'),
		__('Status')
	])
    !!}