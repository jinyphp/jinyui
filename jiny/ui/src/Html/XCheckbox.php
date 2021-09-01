<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Form\CInput;

class XCheckbox extends  CInput
{
    public function __construct($name = null, $value = null) {
		parent::__construct("checkbox", $name, $value);
        
        // 부트스트랩 스타일적용
        $this->addClass("form-check-input");
	}

    public function setChecked()
    {
        $this->setAttribute('checked', '');
		return $this;
    }


    /**
	 * 라이브와이어 속성
	 */
	public function setWireModel($pros)
	{
		$this->setAttribute('wire:model', $pros);
		return $this;
	}
}