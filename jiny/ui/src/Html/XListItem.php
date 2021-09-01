<?php 
namespace Jiny\UI\Html;

use Jiny\Html\Ctag;

class XListItem extends CTag
{
    public function __construct($value = null) 
	{
		parent::__construct("li", true, $value);
	}


}