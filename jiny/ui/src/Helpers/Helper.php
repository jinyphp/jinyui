<?php

function CTabView($data = []) {
	return new \Jiny\UI\CTabView($data);
}

if (!function_exists("CMenu")) {
    function CMenu() {
        return new \Jiny\UI\CMenu();
    }
}

if (!function_exists("CMenuItem")) {
    function CMenuItem($items=null) {
        return new \Jiny\UI\CMenuItem($items);
    }
}


function BCard()
{
    return \Jiny\UI\BCard::instance();
}

function BootNav($ri=null)
{
    return \Jiny\UI\BootNav::instance($ri);
}

function BootTab()
{
    return \Jiny\UI\CTab::instance();
}

function BootButton($item=null)
{
    return new \Jiny\UI\BootButton($item);
}

function BootModal()
{
    return new \Jiny\UI\BootModal();
}

function BootFormItem()
{
    return \Jiny\UI\BootFormItem::instance();
}

function uiStack()
{
    return \Jiny\UI\Stack::instance();
}

function BootCarousel()
{
    return \Jiny\UI\BootCarousel::instance();
}

/**
     * 2차원 배열 정렬
     *
     * @param  mixed $array
     * @param  mixed $key
     * @param  mixed $sort
     * @return void
     */
    function arr_sort( $array, $key, $sort = "asc" )
    {
        $values = [];
        foreach( $array as $k => $v ) {
            $index = $v[$key];
            $values[$index] = $k;
        }

        if ( $sort=='asc') {
            ksort($values);
        } else{
            krsort($values);
        }

        $ret = [];
        foreach($values as $k => $v) {
            array_push($ret, $array[$v]);
        }
  
        return $ret;
    }