<?php
namespace Jiny\UI;

use \Jiny\Html\CDiv;
use \Jiny\Html\CList;
use \Jiny\Html\CListItem;
use \Jiny\Html\CLink;

class CTabView extends CDiv {

	protected $id = 'tabs';

	/**
	 * @var CDiv[]
	 */
	protected $tabs = [];
	protected $headers = [];
	protected $footer = null;
	protected $selectedTab = 0; // 초기값 tab null;
	protected $indicators = [];

	/**
	 * Script for tab change event.
	 */
	private $tab_change_js = '';

	/**
	 * Disabled tabs IDs, tab option
	 *
	 * @var array
	 */
	protected $disabledTabs = [];

	public function __construct($data = []) {
		if (isset($data['id'])) {
			$this->id = $data['id'];
		}
		if (isset($data['selected'])) {
			$this->setSelected($data['selected']);
		}
		if (isset($data['disabled'])) {
			$this->setDisabled($data['disabled']);
		}
		parent::__construct();
		$this->setId(zbx_formatDomId($this->id));
		$this->addClass("tabview");
	}

	public function setActive($selected)
	{
		$this->setSelected($selected);
		return $this;
	}

	public function setSelected($selected) {
		$this->selectedTab = $selected;
		return $this;
	}

	/**
	 * Disable tabs
	 *
	 * @param array		$disabled	disabled tabs IDs (first tab - 0, second - 1...)
	 */
	public function setDisabled($disabled) {
		$this->disabledTabs = $disabled;
		return $this;
	}

	public function addTab($id, $header, $body, $indicator_type = false) {
		// 탭내용
		$key = zbx_formatDomId($id);
		$this->headers[$id] = $header;
		$this->tabs[$id] = (new CDiv($body))->setAttribute('x-show',"tab === '".$key."'"); //alpinjs 코드 추가
		$this->tabs[$id]->setId($key);

		if ($indicator_type) {
			$this->indicators[$id] = $indicator_type;
		}
		return $this;
	}

	public function setFooter($footer) {
		$this->footer = $footer;
		return $this;
	}

	public function toString($destroy = true) {
		if (count($this->tabs) == 1) {
			// 탭 갯수가 하나인 경우, 텝항목을 표시하지 않고
			// 하나로 출력
			$tab = reset($this->tabs);
			$this->addItem($tab);
		}
		else {
			// 여러개의 탭		

			// 텝 메뉴 (ul 요소 생성)
			$headersList = (new CList())->addClass('nav');

			// 텝 이동링크 생성
			foreach ($this->headers as $id => $header) {

				// 이동버튼(a링크)
				$tabLink = (new CLink($header."_$id", '#'.$id))
					->setId('tab_'.$id)
					->setAttribute("@click.prevent", "tab='".$id."'"); // AlpinJS 코드

				$li = new CListItem($tabLink);
				$li->setAttribute(":class", "{'active' : tab === '".$id."'}" ); // AlpinJS

				// 기본 선택 
                if(isset($this->selectedTab) && $this->selectedTab == $id) {
					$li->addClass("active"); // 보여지는 텝은 클래스 추가
                } 

				$headersList->addItem($li);

			}

			$this->addItem($headersList);
			$this->addItem($this->tabs);
		}

		$this->addItem($this->footer);
		$this->setAttribute("x-data", "{tab:'".$this->selectedTab."'}"); // AlpinJS

		return parent::toString($destroy);
	}

}
