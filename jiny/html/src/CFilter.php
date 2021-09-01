<?php
namespace Jiny\Html;

use Jiny\Html\CDiv;
use Jiny\Html\CUrl;
use Jiny\Html\Form\CForm;
use Jiny\Html\Form\CSubmitButton;
use Jiny\Html\Form\CSimpleButton;
use Jiny\Html\Form\CRedirectButton;
use Jiny\Html\Form\CLabel;
use Jiny\Html\CButton;
use Jiny\Html\CDateSelector;

class CFilter extends CDiv {

	// Filter form object.
	private $form;
	// Filter form object name and id attribute.
	private $name = 'zbx_filter';
	// Visibility of 'Apply', 'Reset' form buttons. Visibility is set to all tabs.
	private $show_buttons = true;

	/**
	 * Filter page URL.
	 *
	 * @var object
	 */
	private $url;

	// Array of filter tab headers. Every header is mapped to it content via href(header) and id(content) attribute.
	protected $headers = [];

	// Array of filter tab content.
	protected $tabs = [];

	// jQuery.tabs initialization options.
	protected $tabs_options = [
		'collapsible' => true,
		'active' => false
	];




	public function __construct(CUrl $url) {
		parent::__construct(); // Div	

		$this
			->setAttribute('data-accessible', 1)
			->addClass(ZBX_STYLE_FILTER_SPACE)
			->setId(uniqid('filter_'));

		/*
		$this->url = $url;
		$this->form = (new CForm('get'))
			->cleanItems()
			->setAttribute('name', $this->name);
		*/
	}

	public function getName() {
		return $this->name;
	}



	/**
	 * Set active tab.
	 *
	 * @param int $tab  1 based index of active tab. If set to 0 all tabs will be collapsed.
	 *
	 * @return CFilter
	 */
	public function setActiveTab($tab) 
	{
        $this->tabs_options['active'] = $tab > 0 ? $tab - 1 : false;
		return $this;
	}

	public function addTab($header, $body) 
	{
		$this->headers[] = $header;
		$this->tabs[] = $body;
		return $this;
	}


	/**
	 * Add tab with filter form.
	 *
	 * @param string $header    Tab header title string.
	 * @param array  $columns   Array of filter columns markup.
	 * @param array  $footer    Additional markup objects for filter tab, default null.
	 *
	 * @return CFilter
	 */
	public function addFilterTab($header, $columns, $footer = null) 
	{
		$anchor = 'tab_'.count($this->tabs); // 텝번호


		// 멀티탭
		$body = [];

		// 탭내용
		$row = (new CDiv())->addClass(ZBX_STYLE_ROW); //'row'
		foreach ($columns as $column) {
			$row->addItem((new CDiv($column))->addClass(ZBX_STYLE_CELL)); //'cell'
		}

		$body[] = (new CDiv())
			->addClass(ZBX_STYLE_TABLE) //'table'
			->addClass(ZBX_STYLE_FILTER_FORMS) //'filter-forms'
			->addItem($row);

		/*
		// appy. reset 버튼
		if ($this->show_buttons) {
			$body[] = (new CDiv())
				->addClass(ZBX_STYLE_FILTER_FORMS) //'filter-forms'
				->addItem(
					(new CSubmitButton(__('Apply'), 'filter_set', 1))
						->onClick('javascript: chkbxRange.clearSelectedOnFilterChange();')
				)
				->addItem(
					(new CRedirectButton(__('Reset'),
						$this->url
							->setArgument('filter_rst', 1)
							->getUrl()
					))
						->addClass(ZBX_STYLE_BTN_ALT)
						->onClick('javascript: chkbxRange.clearSelectedOnFilterChange();')
				);
		}

		*/

		// 하단
		if ($footer !== null) {
			$body[] = $footer;
		}
		

		// 탭 추가
		return $this->addTab(
			(new CLink($header, '#'.$anchor))->addClass(ZBX_STYLE_FILTER_TRIGGER),
			(new CDiv($body))
				->addClass(ZBX_STYLE_FILTER_CONTAINER)
				->setId($anchor)
		);
	}




















	





	/**
	 * Render current CFilter object as HTML string.
	 *
	 * @return string
	 */
	public function toString($destroy = true) {
		
		/*
		

		// 기본버튼
		if ($this->tabs_options['active'] !== false
				&& !array_key_exists($this->tabs_options['active'], $this->headers)) {
			$this->tabs_options['active'] = 0;
		}
		*/

		// 버튼생성
		$headers = (new CList())->addClass('filter-btn-container'); // 
		$headers_cnt = 0;
		foreach ($this->headers as $index => $header) {
			
			if ($this->tabs_options['active'] == $index) {
				//$header->addClass('ui-tabs-active');
			} else {
				// 기본 선택이 아닌 부분은 숨김
				$this->tabs[$index]->addStyle('display: none');
			}

			$header->setAttribute("@click.prevent", "tab='filter".$index."'"); // AlpinJS 코드
			$header->setAttribute(":class", "{'ui-tabs-active' : tab === 'filter".$index."'}" );
			
			$li = new CListItem($header);
			$headers->addItem($li); //li 요소
			$headers_cnt++;

			$this->tabs[$index]
				
				->setAttribute('x-show',"tab === 'filter".$index."'"); //alpinjs 코드 추가
			
		}
		

		// 필터탭 버튼 등록
		if ($headers_cnt) {
			$this->addItem($headers)->setAttribute('aria-label', __('Filter'));
		}

		// 필터탭 내용 등록
		$this->addItem($this->tabs);
		$filter = "filter".$this->tabs_options['active'];
		$this->setAttribute("x-data", "{tab:'".$filter."'}"); // AlpinJS

		return parent::toString($destroy); 
	}
}
