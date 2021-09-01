<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Form\CTextArea;

class XTextarea extends CTextArea
{
    /*
    // input fields
define('ZBX_TEXTAREA_HTTP_PAIR_NAME_WIDTH',		218);
define('ZBX_TEXTAREA_HTTP_PAIR_VALUE_WIDTH',	218);
define('ZBX_TEXTAREA_MACRO_WIDTH',				250);
define('ZBX_TEXTAREA_MACRO_VALUE_WIDTH',		300);
define('ZBX_TEXTAREA_MACRO_INHERITED_WIDTH',	180);
define('ZBX_TEXTAREA_TAG_WIDTH',				250);
define('ZBX_TEXTAREA_TAG_VALUE_WIDTH',			300);
define('ZBX_TEXTAREA_MAPPING_VALUE_WIDTH',		250);
define('ZBX_TEXTAREA_MAPPING_NEWVALUE_WIDTH',	250);
define('ZBX_TEXTAREA_COLOR_WIDTH',				96);
define('ZBX_TEXTAREA_FILTER_SMALL_WIDTH',		150);
define('ZBX_TEXTAREA_FILTER_STANDARD_WIDTH',	300);

define('ZBX_TEXTAREA_NUMERIC_STANDARD_WIDTH',	75);
define('ZBX_TEXTAREA_NUMERIC_BIG_WIDTH',		150);
define('ZBX_TEXTAREA_2DIGITS_WIDTH',			35);	// please use for date selector only
define('ZBX_TEXTAREA_4DIGITS_WIDTH',			50);	// please use for date selector only
define('ZBX_TEXTAREA_INTERFACE_IP_WIDTH',		225);
define('ZBX_TEXTAREA_INTERFACE_DNS_WIDTH',		175);
define('ZBX_TEXTAREA_INTERFACE_PORT_WIDTH',		100);
define('ZBX_TEXTAREA_STANDARD_ROWS',			7);
    */
    const TEXTAREA_TINY_WIDTH = 75;
    const TEXTAREA_SMALL_WIDTH = 150;
    const TEXTAREA_MEDIUM_WIDTH = 270;
    const TEXTAREA_STANDARD_WIDTH = 453;
    const TEXTAREA_BIG_WIDTH = 540;


    public function __construct($name = 'textarea', $value = '', $options = []) {
		parent::__construct($name, $value, $options);
        
        // 부트스트랩 스타일적용
        $this->addClass("form-control");
	}

    public function setWidth($width)
    {
        if (is_string($width)) {

            switch ($width) {
                case 'tiny':
                    $this->addStyle('width:'.self::TEXTAREA_TINY_WIDTH.'px;');
                    break;
                case 'small':
                    $this->addStyle('width:'.self::TEXTAREA_SMALL_WIDTH.'px;');
                    break;
                case 'medium':
                    $this->addStyle('width:'.self::TEXTAREA_MEDIUM_WIDTH.'px;');
                    break;
                case 'standard':
                    $this->addStyle('width:'.self::TEXTAREA_STANDARD_WIDTH.'px;');
                    break;
                case 'big':
                    $this->addStyle('width:'.self::TEXTAREA_BIG_WIDTH.'px;');
                    break;
                case 'full':
                    $this->addStyle('width:100%');
                    break;
                case 'half':
                    $this->addStyle('width:50%');
                    break;
                case 'quater':
                    $this->addStyle('width:25%');
                    break;
            }

        } else {
            $this->addStyle('width: '.$width.'px;');
        }

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