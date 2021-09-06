<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;

class XLinks
{
	public $items = [];

	public function __construct($args=[]) {
    	foreach ($args as $arg) {
        	$this->items []= xLink($arg['item'], $arg['url']);
    	}
	}
	
	/**
	 * 단체속성 지정
	 *
	 * @param  mixed $key
	 * @param  mixed $value
	 * @return void
	 */
	public function setAttribute($key, $value)
	{
		foreach ($this->items as &$item) {
			$item->setAttribute($key, $value);
		}
		return $this;
	}

	public function addClass($value)
	{
		foreach ($this->items as &$item) {
			$item->addClass($value);
		}
		return $this;
	}

	public function __toString()
    {
        $res = "";
		foreach ($this->items as $item) {
			$res .= $item->toString();
		}

        return $res;
	}



}