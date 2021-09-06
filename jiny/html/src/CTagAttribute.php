<?php
namespace Jiny\Html;

trait CTagAttribute
{
    
	public function setName($value) {
		$this->setAttribute('name', $value);
		return $this;
	}

	public function getName() {
		return $this->getAttribute('name');
	}


    public function setTitle($value) {
		$this->setAttribute('title', $value);
		return $this;
	}

	public function setId($id) {
		$this->setAttribute('id', $id);
		return $this;
	}

	public function getId() {
		return $this->getAttribute('id');
	}

    /**
	 * Remove ID attribute from tag.
	 *
	 * @return CTag
	 */
	public function removeId() {
		$this->removeAttribute('id');
		return $this;
	}

    /**
	 * Set or reset element 'aria-required' attribute.
	 *
	 * @param bool $is_required  Define aria-required attribute for element.
	 *
	 * @return $this
	 */
	public function setAriaRequired($is_required = true) {
		if ($is_required) {
			$this->setAttribute('aria-required', 'true');
		}
		else {
			$this->removeAttribute('aria-required');
		}

		return $this;
	}

	public function setAriaLabel($value)
	{
		$this->setAttribute('aria-label',$value);
		return $this;
	}

	public function setAriaCurrent($value)
	{
		$this->setAttribute('aria-current',$value);
		return $this;
	}



	public function role($value) {
		return $this->setAttribute('role', $value);
	}

    /**
     * 스타일시트
     */
	public function addStyle($value) {
		if (!isset($this->_attributes['style'])) {
			$this->_attributes['style'] = '';
		}
		if (isset($value)) {
			$this->_attributes['style'] .= htmlspecialchars(strval($value));
		}
		else {
			unset($this->_attributes['style']);
		}
		return $this;
	}
    


    public function getAttribute($name) {
		return isset($this->_attributes[$name]) ? $this->_attributes[$name] : null;
	}

	public function setAttribute($name, $value) {
		if (is_object($value)) {
			$value = unpack_object($value);
		}
		elseif (is_array($value)) {
			$value = CHtml::serialize($value);
		}
		$this->_attributes[$name] = $value;
		return $this;
	}



        
    /**
     * 라이브와아어 attributes 속성 병합
     *
     * @param  mixed $obj
     * @return void
     */
    public function setLivewireAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                $this->setAttribute($name, $value);
            }
        }
        return $this;
    }

    public function removeAttribute($name) {
		unset($this->_attributes[$name]);
		return $this;
	}


    /**
     * 클래스 속성 지정
     *
     * @param  mixed $class
     * @return void
     */
    public function addClass($class) {
		if ($class !== null) {
			if (!array_key_exists('class', $this->_attributes) || $this->_attributes['class'] === '') {
				// $this->_attributes['class'] = $class;
				$this->_attributes['class'] = [ $class ]; // 배열 세팅
			}
			else {
				//$this->_attributes['class'] .= ' '.$class;
				$this->_attributes['class'] []= $class;
			}
		}

		return $this;
	}
	


	/**
	 * isClass
	 *
	 * @param  mixed $name
	 * @return void
	 */
	public function isClass($name)
	{
		if (isset($this->_attributes['class'])) {
			return in_array($name, $this->_attributes['class'], true);
		}
		return false;
	}



}
