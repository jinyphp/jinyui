<?php 
namespace Jiny\UI;

class Table
{
    private static $Instance;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();

            return self::$Instance;
        } else {
            // 인스턴스가 중복
            return self::$Instance; 
        }
    }

    public $bulkCheck = false;
    public $headRows;
    public $headAttrs;
    public $headSlot;
    public $bodyRows;
    public $bodyAttrs;
    public $bodySlot;

    public function init()
    {
        $this->bulkCheck = false;
        $this->headRows=[];
        $this->headAttrs=[];
        $this->headSlot=null;
        $this->bodyRows=[];
        $this->bodyAttrs=[];
        $this->bodySlot=null;
    }


    public function check($bulk=true)
    {
        $this->bulkCheck = $bulk;
        return $this;
    }

    public function rowCheck($i)
    {
        $input = (new \Jiny\Html\CTag("input",true))
            ->setAttribute("type", "checkbox")
            ->setAttribute("id", "ids_".$i)
            ->setAttribute("name", "ids")
            ->setAttribute("value", $i)
            ->addClass("form-check-input rowCheckbox");
            // wire:model="selected" click="selectCheckbox($event, {{$i}})"

        $label = (new \Jiny\Html\CTag("label",true))
            ->setAttribute("for", "ids_".$i)
            ->addClass("form-check-label")
            ->addHtml("&nbsp;");

        return (new \Jiny\Html\CTag("div",true))
            ->addClass("form-check")
            ->addItem($input)->addItem($label);
    }

    public function allCheck()
    {
        $input = (new \Jiny\Html\CTag("input",true))
            ->setAttribute("type", "checkbox")
            ->setAttribute("id", "all_checks")
            ->setAttribute("name", "all_checks")
            ->addClass("form-check-input rowCheckbox");
            // @click="selectAllCheckbox($event);">

        $label = (new \Jiny\Html\CTag("label",true))
            ->setAttribute("for", "all_checks")
            ->addClass("form-check-label")
            ->addHtml("&nbsp;");

        return (new \Jiny\Html\CTag("div",true))
            ->addClass("form-check")
            ->addItem($input)->addItem($label);
    }

    
    public function setDataHead($rows, $attrs=[], $slot=null)
    {
        $this->headRows=$rows;
        $this->headAttrs=$attrs;
        $this->headSlot=$slot;
    }

    
    public function setDataBody($rows, $attrs=[], $slot=null)
    {
        $this->bodyRows=$rows;
        $this->bodyAttrs=$attrs;
        $this->bodySlot=$slot;
    }

    public function dataBody()
    {
        $rows = $this->bodyRows;
        $attrs=$this->bodyAttrs; 
        $slot=$this->bodySlot;

        $tbody = new \Jiny\Html\CTag("tbody",true);
        $_td = (new \Jiny\Html\CTag("td",true));
        $_tr = new \Jiny\Html\CTag("tr",true);

        foreach($rows as $i => $row) {
            $tr = clone $_tr;
            
            if($this->bulkCheck) {
                $td = (clone $_td)->addItem($this->rowCheck($i));
                $tr->addItem($td->addStyle("width: 20px;"));
            }

            foreach($row as $item) {
                $td = (clone $_td)->addItem($item);
                $tr->addItem($td);
            }
            $tbody->addItem($tr);
        }

        if(!empty($slot)) $tbody->addItem($slot);

        return $this->setAttrs($tbody, $attrs);
        //return $tbody;
    }


    public function dataHead()
    {

        $title=$this->headRows;
        $attrs=$this->headAttrs;
        $slot=$this->headSlot;

        $thead = new \Jiny\Html\CTag("thead",true);
        $_th = (new \Jiny\Html\CTag("th",true));
        $tr = new \Jiny\Html\CTag("tr",true);
        
        if($this->bulkCheck) {
            $th = (clone $_th)->addItem($this->allCheck());
            $tr->addItem($th->addStyle("width: 20px;"));
        }

        //dd($title);

        foreach($title as $item) {
            $th = (clone $_th)->addItem($item['title']);
            $tr->addItem($th);
        }

        $thead->addItem($tr);

        if(!empty($slot)) $thead->addItem($slot);

        return $this->setAttrs($thead, $attrs);
        //return $thead;
    }

    private function setAttrs($item, $attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "href") {
                    $item->setUrl($value);
                    continue;
                } else if ($name === "class") {

                    $item->addClass($value);
                    continue;
                }
                $item->setAttribute($name, $value);
            }
        }
        return $item;
    }


}