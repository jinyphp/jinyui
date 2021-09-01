<?php
namespace Jiny\Html;

trait CTagStyle
{

    public function style($value) {
        return $this->addStyle($value);
    }

    public function color($value)
    {
        return $this->addStyle("color:".$value);
    }


}
