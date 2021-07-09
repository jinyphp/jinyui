
        <br>
        {!! CSelect("language",['ko'=>"korean", 'en'=>"english"]) !!}

<br><br><br>

        <br>
        {{ CMultiSelect([
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
            ->setAriaRequired() }}


<br>
CSelect
        {!!
            CSelect('lang','en')


            ->addOptions(['ko'=>"korean", 'en'=>"english"])
            ->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH)
        !!}
