

{{
    (new \Jiny\Html\Form\CRadioButtonList('filter_status', "any"))
					->addValue(__('Any'), -1)
					->addValue(__('Enabled'), 0)
					->addValue(__('Disabled'), 1)
					->setModern(true)
}}
{!!
(new \Jiny\Html\Form\CRadioButtonList('filter_status', -1))
					->addValue(__('Any'), -1)
					->addValue(__('Enabled'), 0)
					->addValue(__('Disabled'), 1)
					->setModern(true) !!}



{!!
    (new \Jiny\Html\Form\CRadioButtonList('filter_status2', -1))
                        ->addValue(__('Any'), -1)
                        ->addValue(__('Enabled'), 0)
                        ->addValue(__('Disabled'), 1)->makeVertical()
                        !!}


{!!
    (new \Jiny\Html\Form\CTextArea('description', 'description'))->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH)
!!}

<br>