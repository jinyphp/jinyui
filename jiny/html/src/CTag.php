<?php

namespace Jiny\Html;

use \Jiny\Html\Form\CForm;

class CTag extends CObject
{
    use CTagStyle, CTagAttribute;

	/**
	 * Encodes the '<', '>', '"' and '&' symbols.
	 */
	const ENC_ALL = 1;

	/**
	 * Encodes all symbols in ENC_ALL except for '&'.
	 */
	const ENC_NOAMP = 2;

	/**
	 * The HTML encoding strategy to use for the contents of the tag.
	 *
	 * @var int
	 */
	protected $encStrategy = self::ENC_NOAMP;

	/**
	 * The HTML encoding strategy for the "value", "name" and "id" _attributes.
	 *
	 * @var int
	 */
	protected $attrEncStrategy = self::ENC_ALL;

	/**
	 * Hint element for the current CTag.
	 *
	 * @var CSpan
	 */
	protected $hint = null;

	public function __construct($tagname, $paired = false, $body = null) {
		parent::__construct();

		$this->_attributes = []; // 테그 속성배열
		$this->tagname = $tagname; // 테그이름
		$this->paired = $paired; // 테그쌍 여부

		if (!is_null($body)) {
            // 테그내 아이템 추가함
			$this->addItem($body);
		}

		// $this->setTheme();
	}

	/**
	 * css 테마 설정
	 *
	 * @param  mixed $theme
	 * @return void
	 */
	protected $theme = "jiny";	
	public function setTheme($theme=null)
	{
		if ($theme) {
			$this->theme = $theme;
		}

		$this->addClass($this->theme); //jinyCSS 스타일적용
		return $this;
	}

    /**
     * 태그생성
     */
	// html 태그 앞뒤에 줄 바꿈 기호 (\ n)를 넣지 마십시오. 원하지 않는 곳에 공백이 추가됩니다.
	protected function startToString() {
		$res = '<'.$this->tagname;// 시작테그 생성

		foreach ($this->_attributes as $key => $value) {

			if ($value === null ) {
				continue; // 값이 없는 속성은 제외
			}

			if ($key == "class" && is_array($value)) {
				$value = implode(" ", $value);
			}

			// "value", "name"및 "id"속성에는 특수 인코딩 전략을 사용해야합니다.
			$strategy = in_array($key, ['value', 'name', 'id'], true) ? $this->attrEncStrategy : $this->encStrategy;
			$value = $this->encode($value, $strategy);
			$res .= ' '.$key.'="'.$value.'"';
		}
		
        $res .= ($this->paired) ? '>' : '/>'; //html5 tag

		return $res;
	}

	protected function endToString() {
		$res = ($this->paired) ? '</'.$this->tagname.'>' : '';

		return $res;
	}

    /**
     * 객체출력
     */
	protected function bodyToString() {
		return parent::toString(false);
	}

	public function toString($destroy = true) {
		$res = $this->startToString();
		$res .= $this->bodyToString();
		$res .= $this->endToString();

        // 힌트테그가 있는 경우 코드추가
		if ($this->hint !== null) {
			$res .= $this->hint->toString();
		}

		if ($destroy) {
			$this->destroy(); //CObject
		}

		return $res;
	}

    // 테그 아이템 추가
	public function addItem($value) {
		if (is_string($value)) {
            // 아이템값이 문자열인경우, 인코딩합니다.
			$value = $this->encode($value, $this->getEncStrategy());
		}

		parent::addItem($value); //CObject
		return $this;
	}

	public function addItems($val=[])
	{
		foreach ($val as $item) {
			$this->addItem($item);
		}
	}

	// 엔코딩 없이 html코드 추가
	public function addHtml($value) {
		parent::addItem($value);
		return $this;
	}


	/**
	 * 브라우저에 출력하기 전에 주어진 전략에 따라 문자열을 삭제합니다.
	 *
	 * @param string	$value
	 * @param int		$strategy
	 *
	 * @return string
	 */
	protected function encode($value, $strategy = self::ENC_NOAMP) {
		if ($strategy == self::ENC_NOAMP) {
			$value = str_replace(
				['<', '>', '"'], 
				['&lt;', '&gt;', '&quot;'], 
				$value);
		}
		else {
			$value = CHtml::encode($value);
		}

		return $value;
	}

	/**
	 * @param int $encStrategy
	 */
	public function setEncStrategy($encStrategy) {
		$this->encStrategy = $encStrategy;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getEncStrategy() {
		return $this->encStrategy;
	}







    private function addAction($name, $value) {
		$this->_attributes[$name] = $value;
		return $this;
	}













    /**
     * javascript event
     */
    public function onChange($script) {
		$this->addAction('onchange', $script);
		return $this;
	}

	public function onClick($script) {
		$this->addAction('onclick', $script);
		return $this;
	}

	public function onMouseover($script) {
		$this->addAction('onmouseover', $script);
		return $this;
	}

	public function onMouseout($script) {
		$this->addAction('onmouseout', $script);
		return $this;
	}

	public function onKeyup($script) {
		$this->addAction('onkeyup', $script);
		return $this;
	}




    /**
     * form
     */
	public function getForm($method = 'post', $action = null, $enctype = null) {
		$form = (new CForm($method, $action, $enctype))
			->addItem($this);
		return $form;
	}

	/**
	 * Adds a hint box to the element.
	 *
	 * @param string|array|CTag		$text				Hint content.
	 * @param string				$span_class			Wrap the content in a span element and assign this class
	 *													to the span.
	 * @param bool					$freeze_on_click	If set to true, it will be possible to "freeze" the hint box
	 *													via a mouse click.
	 * @param string				$styles				Custom css styles.
	 *													Syntax:
	 *														property1: value1; property2: value2; property(n): value(n)
	 *
	 * @return CTag
	 */
	public function setHint($text, $span_class = '', $freeze_on_click = true, $styles = '') {
		$this->hint = (new CDiv($text))
			->addClass('hint-box')
			->setAttribute('style', 'display: none;');

		$this->setAttribute('data-hintbox', '1');

		if ($span_class !== '') {
			$this->setAttribute('data-hintbox-class', $span_class);
		}
		if ($styles !== '') {
			$this->setAttribute('data-hintbox-style', $styles);
		}
		if ($freeze_on_click) {
			$this->setAttribute('data-hintbox-static', '1');
		}

		return $this;
	}

	/**
	 * Add a hint box with preloader to the element.
	 *
	 * @param array  $data
	 * @param string $span_class
	 * @param bool   $freeze_on_click
	 * @param string $styles
	 *
	 * @return $this
	 */
	public function setAjaxHint(array $data, string $span_class = '', bool $freeze_on_click = true,
			string $styles = ''): CTag {
		$this
			->setAttribute('data-hintbox-preload', $data)
			->setHint('', $span_class, $freeze_on_click, $styles);

		return $this;
	}

	/**
	 * Set data for menu popup.
	 *
	 * @param array $data
	 */
	public function setMenuPopup(array $data) {
		$this->setAttribute('data-menu-popup', $data);
		$this->setAttribute('aria-expanded', 'false');

		if (!$this->getAttribute('disabled')) {
			$this->setAttribute('aria-haspopup', 'true');
		}

		return $this;
	}

	public function error($value) {
		error('class('.get_class($this).') - '.$value);
		return 1;
	}

}
