

{!! CTabView()
    ->setSelected('userTab2')
    ->addTab('userTab', __('User'), "aaa") 
    ->addTab('userTab2', __('User2'), "bbb") 
    !!}

<br>
필터 : =====
<br>

{!!
(new \Jiny\Html\CFilter((new \Jiny\Html\CUrl('zabbix.php'))->setArgument('action', 'user.list')))
	
		->setActiveTab(2)
		->addFilterTab(__('Filter'), ["필터내용"])
        ->addFilterTab(__('display'), ["dddddd필터내용"])
	
	
!!}

<br><br><br>