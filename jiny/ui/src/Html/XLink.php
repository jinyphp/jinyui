<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;

class XLink extends CTag
{
    private $url;
	public function __construct($item = null, $url = null) {
		parent::__construct('a', true);

		if ($item !== null) {
			$this->addItem($item);
		}
		$this->url = $url;
	}

    public function setHref($url)
	{
		$this->url = $url;
		return $this;
	}

	public function setUrl($url) 
	{
		$this->url = $url;
		return $this;
	}

	public function setTarget($value = null) {
		$this->attributes['target'] = $value;
		return $this;
	}

	public function setButton($color, $outline=null)
	{
		$this->addClass("btn");//bootstrap css

		if ($color) {
			if($outline) {
				$this->addClass("btn-outline-".$color); //bootstrap css
			} else {
				$this->addClass("btn-".$color); //bootstrap css
			}
		}

		return $this;
	}

	public function setActive()
	{
		$this->addClass("active"); //bootstrap css
		return $this;
	}

	public function setAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "href") {
                    $this->setUrl($value);
                    continue;
                } else if ($name === "class") {

                    $this->addClass($value);
                    continue;
                }
                $this->setAttribute($name, $value);
            }
        }
        return $this;
    }

    public function toString($destroy = true) {
		$url = $this->url;

		if ($url === null) {
			$this->setAttribute('role', 'button');
		}

		$this->setAttribute('href', ($url == null) ? 'javascript:void(0)' : $url);


        return parent::toString($destroy);
    }


}