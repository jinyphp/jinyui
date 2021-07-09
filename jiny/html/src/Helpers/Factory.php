<?php

/**
 * 기본테그
 */

function CDiv($items = null) {
    if($items) {
        return new \Jiny\Html\CDiv($items);
    } else {
        static $obj; //flyweight pattern
        if (!$obj) {
            $obj = new \Jiny\Html\CDiv();
        }
        return $obj;
    }	
}


function CLink($items = null) {
	return new \Jiny\Html\CLink($items);
}

function CSpan($items = null) {
	return new \Jiny\Html\CSpan($items);
}

/**
 * 테이블
 */

function CTable() {
    return new \Jiny\Html\Table\CTable();
}

function CTableInfo() {
    return new \Jiny\Html\Table\CTableInfo();
}

function CRow($item = null, $heading_column = null) {
    // tr 테그
    return new \Jiny\Html\Table\CRow($item, $heading_column);
}

function CCol($item = null) {
    // td 테그
    return new \Jiny\Html\Table\CCol($item);
}

function CColHeader($item = null) {
    // th 테그
    return new \Jiny\Html\Table\CColHeader($item);
}

function CRowHeader() {
    return new \Jiny\Html\Table\CRowHeader();
}