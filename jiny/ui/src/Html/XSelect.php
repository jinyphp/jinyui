<?php 
namespace Jiny\UI\Html;

use Jiny\Html\CTag;
use Illuminate\Support\Facades\DB;

class XSelect extends CTag
{

    const TEXTAREA_TINY_WIDTH = 75;
    const TEXTAREA_SMALL_WIDTH = 150;
    const TEXTAREA_MEDIUM_WIDTH = 270;
    const TEXTAREA_STANDARD_WIDTH = 453;
    const TEXTAREA_BIG_WIDTH = 540;


    public function __construct($name = null) {
		parent::__construct("select", true);

        if ($name) {
            $this->setAttribute("name",$name);
        }
        
        
        // 부트스트랩 스타일적용
        $this->addClass("form-control");
	}

    public function addSlot($slot)
    {
        $this->addItem($slot);
        return $this;
    }

    public function addOption($title, $value=null)
    {
        $option = new CTag("option",true,$title);
        if ($value) {
            $option->setAttribute("value",$value);
        }
        $this->addItem($option);
        return $this;
    }

    public function addOptions($args)
    {
        foreach ($args as $key => $option) {
            if (is_array($option)) {
                // ['title'=>"", 'value'=>""]
                $this->addOption($option['title'], $option['value']);
            } else {
                $this->addOption($option, $key);
            }
            
        }
        return $this;
    }

    public function rangeOption(...$num)
    {
        if(count($num) == 1) {
            foreach(range(1,$num[0]) as $i) {
                $this->addOption($i, $i);
            }
        } else if(count($num) == 2) {
            foreach(range($num[0],$num[1]) as $i) {
                $this->addOption($i, $i);
            }
        } else {
            foreach($num as $i) {
                $this->addOption($i, $i);
            }
        }
        return $this;
    }

    public function addTable($tablename, $field, $filter=[])
    {
        $db = DB::table($tablename);

        # 필터 조건
        $db = $db->where("enable", "like", "%on%");
        foreach($filter as $key => $value) {
            if($value) {
                $db = $db->where($key, "like", "%".$value."%");
            }            
        }

        $rows = $db->orderBy($field, "desc")->get();

        foreach ($rows as $row) {
            $value = $row->id.":".$row->$field;
            $this->addOption($row->$field, $value);
        }

        return $this;
    }

    public $default;
    public function setSelected($value)
    {
        $this->default = $value;
        foreach($this->items as $item)
        {
            $key = explode(":", $item->_attributes['value']);
            if ($key[0] == $value || $key[1] == $value) {
                $item->_attributes['selected'] = " ";
            }
        }
        return $this;
    }

    public function size($size)
    {
        if ($size == "lg") {
            $this->addClass("form-control-lg");
        } else if ($size == "lg") {
            $this->addClass("form-control-sm");
        }
        
        return $this;
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
     * 속성을 부여합니다.
     *
     * @param  mixed $attrs
     * @return void
     */
    public function setAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            // 커스텀 속성을 분석합니다.     
            $attrs = $this->attrParser($attrs);

            foreach($attrs as $name => $value) {
                if ($name === "class") {
                    $this->addClass($value);
                    continue;
                }
                $this->setAttribute($name, $value);
            }
        }
        return $this;
    }

    private function attrParser($attrs)
    {
        
        if (isset($attrs["width"])) {
            $this->setWidth($attrs["width"]);
            unset($attrs["width"]);
        }

        return $attrs;
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