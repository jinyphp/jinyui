<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;

class XRadioGroup extends CTag 
{
	public $theme;
	public function __construct($theme=null) {
		parent::__construct('div', true); // CTag
        
		$this->theme = $theme;
        // 부트스트랩 스타일적용
        //$this->addClass("form-control");
	}

	// 라디오버튼
	public function addRadio($radio, $title, $attrs=null)
	{
		$item = xRadioLabel($radio, $title);

		if($attrs) {
			$item->addClass($attrs);
		}

		$this->addItem($item);
		return $this;
	}

	public function setInline()
	{
		$this->theme = "inline";
		return $this;
	}

	public function toString($destroy = true) 
	{
		if($this->theme == "inline") {
			foreach($this->items as &$item) {
				$item->addClass("form-check-inline");
			}			
		}

		return parent::toString($destroy);
	}
	


}