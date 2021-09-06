<?php

namespace Jiny\Html;
use Illuminate\View\Component;

class CObject extends Component
{
    public $blade;
	public $items;

	public function __construct($items = null)
    {
		$this->items = [];
		if (isset($items)) {
			$this->addItem($items);
		}

	}


    /**
     * 객체 출력
     */
	public function show($destroy = true)
    {
		echo $this->toString($destroy);
		return $this;
	}

    public function get()
    {
        return $this->toString();
    }

	public function toString($destroy = true)
    {
		$res = "";
        $res .= implode('', $this->items);
		if ($destroy) {
			$this->destroy();
		}

		return $res;
	}

	public function __toString()
    {
        return $this->toString();
	}

    /**
     * 초기화
     */
	public function destroy()
    {
		$this->cleanItems();
		return $this;
	}

	public function cleanItems() {
		$this->items = [];
		return $this;
	}

    /**
     *
     */
	public function itemsCount()
    {
		return count($this->items);
	}

	public function addItem($value)
    {
		if (is_object($value)) {
            // 객체 아이템
			//array_push($this->items, unpack_object($value));
			array_push($this->items, $value);
		}
		elseif (is_string($value)) {
            // 문자열
			array_push($this->items, $value);
		}
		elseif (is_array($value)) {
            // 배열
			foreach ($value as $item) {
				$this->addItem($item); // 주의, 재귀호출
			}
		}
		elseif (!is_null($value)) {
			array_push($this->items, unpack_object($value));
		}
		return $this;
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return $this->toString();
    }

}

/**
 * html 헬퍼함수
 */
use \Illuminate\Support\HtmlString;

function unpack_object(&$item) {
	$res = '';

    if (is_object($item)) {
		
		if($item instanceof HtmlString) {
			// 리라벨 컴포넌트
			$res = $item->toHtml();
		} else {

			$res = $item->toString(false);
		}		
	}
	else
    if (is_array($item)) {
		foreach ($item as $id => $dat) {
			$res .= unpack_object($item[$id]); // 주의, 재귀호출
		}
	}
	else
    if (!is_null($item)) {
		$res = strval($item);
		unset($item);
	}
	return $res;
}


