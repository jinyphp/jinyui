<?php 
namespace Jiny\UI\Components;

use CTag as GlobalCTag;
use Jiny\Html\Ctag;

class XNav
{
    /**
     * 싱글턴
     */
    private static $Instance;
    public static function instance()
    {
        if (!isset(self::$Instance)) {             
            self::$Instance = new self();
            self::$Instance->init();
        } 
        return self::$Instance; 
    }

    public function __toString()
    {
        $res = "";
        return $res;
	}

    public $tag;
    private function init()
    {
        self::$Instance->tag = new CTag('ul', true);
    }

    public function addItem($item)
    {
        $li = new CTag('li', true, $item);
        $li->addClass("nav-item"); // bootstrap css

        $this->tag->addItem($li);
        return $this;
    }

    public function setHtml($slot)
    {
        $this->tag->addHtml($slot);
        return $this;
    }

    public function show()
    {
        $res = $this->tag->addClass('nav');

        $this->init();
        return $res;
    }

    public function center()
    {
        $this->tag->addClass("justify-content-center");
        return $this;
    }

    public function end()
    {
        $this->tag->addClass("justify-content-end");
        return $this;
    }

    public function virtical()
    {
        $this->tag->addClass("flex-column");
        return $this;
    }

    public function tab()
    {
        $this->tag->addClass("nav-tabs");
        return $this;
    }

    public function pills()
    {
        $this->tag->addClass("nav-pills");
        return $this;
    }

    public function setTagAttrs($attrs)
    {
        if (is_object($attrs) || is_array($attrs)) {
            foreach($attrs as $name => $value) {
                if ($name === "href") {
                    $this->tag->setUrl($value);
                    continue;
                } else if ($name === "class") {

                    $this->tag->addClass($value);
                    continue;
                }
                $this->tag->setAttribute($name, $value);
            }
        }
        return $this;
    }



}