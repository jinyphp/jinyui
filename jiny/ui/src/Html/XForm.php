<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;
use Jiny\UI\Html\XFormHor;
use Jiny\UI\Html\XFormRow;

class XForm 
{
    /**
     * 싱글턴
     */
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {             
            self::$Instance = new self();
            self::$Instance->form = new CTag('form', true);
        } 
        return self::$Instance; 
    }



    public $form;
    public function __toString()
    {
        return $this->form->toString();
        $res = "";
        return $res;
	}
}