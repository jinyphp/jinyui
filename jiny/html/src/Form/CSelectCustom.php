<?php
namespace Jiny\Html\Form;

use \Jiny\Html\Ctag;
/**
 * 라디오 버튼을 이용한 커스텀 셀렉터
 */
class CSelectCustom extends CTag {

	/**
	 * @var string
	 */
	protected $name;
	protected $value;
	protected $options = [];
	protected $placeholder = "select item";


	/**
	 * 외각 div 박스 생성
	 * @param string $name
	 */
	public function __construct(string $name, $value=null) {
		parent::__construct('div', true);
		$this->name = $name;
		$this->value = $value;
	}

	public function setValue($value): self 
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @param string|null $name
	 *
	 * @return self
	 */
	public function setName($name): self {
		$this->name = $name;
		return $this;
	}


	public function setWidth($value) {
		$this->addStyle('width: '.$value.'px;');
		return $this;
	}

	public function setAdaptiveWidth($value) {
		$this->addStyle('max-width: '.$value.'px;');
		$this->addStyle('width: 100%;');
		return $this;
	}

		

	public function addOption($label, $value=null): self 
	{


		$opt = (new \Jiny\Html\CDiv())->addClass('option');

		$radio = (new \Jiny\Html\Ctag('input'))
			->setAttribute('type',"radio")
			->setAttribute('name',$this->name)
			->setAttribute('value',$value)
			->addClass("radio");

		if ($value == $this->value) {
			$radio->setAttribute('selected','');
			$this->placeholder = $label;
			//$radio->addClass('active');

			
		}
		$opt->addItem($radio);

		$label = (new \Jiny\Html\Ctag('label',true, $label));
		$label->setAttribute("@click.prevent", "hello()"); // AlpinJS 코드	
		$opt->addItem($label);

		/*
		<div class="option">
                    <input type="radio" name="category" id="aaa" class="radio">
                    <label for="aaa">AAA</label>
                </div>
		*/
		/*
		$opt = new CTag('option', true, $label);
		if ($value) {
			$opt->setAttribute('value', $value);
			if($this->value == $value) $opt->setAttribute('selected',"");
		}
		*/

		$this->options[] = $opt;

		return $this;
	}


	public function addOptions(array $options): self {
		foreach ($options as $value => $label) {
			$this->addOption($label,$value);
		}
		return $this;
	}

	/**
	 * 객체 출력 처리 부분
	 */

	public function toString($destroy = true) 
	{
		
		$default = (new \Jiny\Html\CDiv($this->placeholder))->addClass('selected');
		$default ->setAttribute("@click", "expend='true'"); // AlpinJS 코드
		//$default->setAttribute("expend=", "tab='".$id."'"); // AlpinJS 코드	
		$this->addItem($default);

		$container = (new \Jiny\Html\CDiv())->addClass('option-container');
		foreach($this->options as $option) {
			$container->addItem($option);
		}
		$container->setAttribute('x-show',"expend === true");
	
		$this->addItem($container);


		$this->setAttribute("x-data", "{expend:false }"); // AlpinJS
		$this->addClass("select-box");
		return parent::toString($destroy);
	}
}
