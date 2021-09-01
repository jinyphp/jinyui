<?php

/**
 * 기본테그
 */

function CDiv($items = null) {
    if($items) {
        return new \Jiny\Html\CDiv($items);
    } else {
        //static $obj; //flyweight pattern
        //if (!$obj) {
            $obj = new \Jiny\Html\CDiv();
        //}
        return $obj;
    }	
}

function CSmall($items = null) {
	return new \Jiny\Html\CSmall($items);
}

function CSvg($items = null) {
	return new \Jiny\Html\CSvg($items);
}


function CLink($items = null) {
	return new \Jiny\Html\CLink($items);
}

function CSpan($items = null) {
	return new \Jiny\Html\CSpan($items);
}

function CListItem($items = null) {
	return new \Jiny\Html\CListItem($items);
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

/**
 * Forms
 */
function CForm(){
	return new \Jiny\Html\Form\CForm();
}

function CLabel($label=null, $for = null){
	return new \Jiny\Html\Form\CLabel($label, $for);
}




function CEmail(){
    return new \Jiny\Html\Form\CInput($type = 'email');
}

function CPassword(){
    return new \Jiny\Html\Form\CInput($type = 'password');
}

function CFile(){
    return new \Jiny\Html\Form\CInput($type = 'file');
}

function CTextBox($name = 'textbox', $value = '', $readonly = false, $maxlength = 255) {
	return new \Jiny\Html\Form\CTextBox($name, $value, $readonly, $maxlength);
}

function CCheckBox($name = 'checkbox', $value = '1') {
	return new \Jiny\Html\Form\CCheckBox($name, $value);
}

function CSelect($name, $value=null) {
	return new \Jiny\Html\Form\CSelect($name, $value);
}

function CMultiSelect(array $options = []) {
	return new \Jiny\Html\Form\CMultiSelect($options);
}

function CFormList($id=null) {
	return new \Jiny\Html\Form\CFormList($id);
}


function CRadioButtonList($name, $value) {
	return new \Jiny\Html\Form\CRadioButtonList($name, $value);
}

function CTextarea(){
    return new \Jiny\Html\Form\CTextArea();
}



