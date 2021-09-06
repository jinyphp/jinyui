<?php
namespace Jiny\Html;

class CLink extends CTag 
{

	
	private	$confirm_message = '';
	

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



	/*
	 * Add a "sid" argument into the URL.
	 * POST method will be used for the "sid" argument.
	 */
	private	$use_sid = false;
	public function addSID() {
		$this->use_sid = true;
		return $this;
	}


	/*
	 * Add a confirmation message
	 */
	public function addConfirmation($value) {
		$this->confirm_message = $value;
		return $this;
	}



	public function toString($destroy = true) {
		$url = $this->url;

		if ($url === null) {
			$this->setAttribute('role', 'button');
		}

		if ($this->use_sid) {
			if (array_key_exists(ZBX_SESSION_NAME, $_COOKIE)) {
				$url .= (strpos($url, '&') !== false || strpos($url, '?') !== false) ? '&' : '?';
                /*
                hojin
				$url .= 'sid='.substr(CSessionHelper::getId(), 16, 16);
                */
			}
			$confirm_script = ($this->confirm_message !== '')
				? 'Confirm('.CHtml::encode(json_encode($this->confirm_message)).') && '
				: '';
			$this->onClick("javascript: return ".$confirm_script."redirect('".$url."', 'post', 'sid', true)");
			$this->setAttribute('href', 'javascript:void(0)');
		}
		else {
			$this->setAttribute('href', ($url == null) ? 'javascript:void(0)' : $url);

			if ($this->confirm_message !== '') {
				$this->onClick('javascript: return Confirm('.json_encode($this->confirm_message).');');
			}
		}

		return parent::toString($destroy);
	}
}
