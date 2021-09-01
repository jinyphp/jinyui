
        {!! CFormList('user_form_list')->addRow(
            CLabel(__('Username'), 'username')->setAsteriskMark(),
			CTextBox('username', "값")
				->setReadonly(true)
				->setWidthStandard()
				->setAriaRequired()
				->setAutofocus()
				->setMaxLength(200)
            )
            ->addRow(
			CLabel(__('Groups'), 'user_groups__ms')->setAsteriskMark(),
			CMultiSelect([
				'name' => 'user_groups[]',
				'object_name' => 'usersGroups',
				'data' => '그룹',
				'popup' => [
					'parameters' => [
						'srctbl' => 'usrgrp',
						'srcfld1' => 'usrgrpid',
						'dstfrm' => '이름',
						'dstfld1' => 'user_groups_'
					]
				]
			])
				->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH)
				->setAriaRequired()
		) !!}
        <br>