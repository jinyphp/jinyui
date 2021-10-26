<?php

/**
 * xtag function
 */

function xDiv($items = null) {
    return new \Jiny\Html\CDiv($items);	
}


/**
 * form
 */
function xForm()
{
    return \Jiny\UI\Html\XForm::instance();
}

function xFormItem()
{
    return \Jiny\UI\Html\XFormItem::instance();
}

function xInput($type = 'text', $name = null, $value = null) {
    $input = new \Jiny\UI\Html\XInput($type, $name, $value);
    return $input;
}

function xInputText($name = null, $value = null)
{
    return xInput('text', $name, $value);
}

function xInputEmail($name = null, $value = null)
{
    return xInput('email', $name, $value);
}

function xInputPassword($name = null, $value = null)
{
    return xInput('password', $name, $value);
}

function xFormSubmit($value = null)
{
    return xInput('submit', null, $value);
}

function xCheckbox($name = null, $value = null){
    $input = new \Jiny\UI\Html\XCheckbox($name, $value);
    return $input;
}

function xRadio($name = null, $value = null){
    $input = new \Jiny\UI\Html\XRadio($name, $value);
    return $input;
}

function xSelect($name = null){
    $select = new \Jiny\UI\Html\XSelect($name);
    return $select;
}

function xTextarea($name = null, $value = null, $options=[]){
    $input = new \Jiny\UI\Html\XTextarea($name, $value, $options);
    return $input;
}

function xRadioLabel($radio, $title = null){
    return CLabel()
			->addItem($radio)
			->addItem(CSpan($title)->addClass("form-check-label"))
            ->addClass("form-check");
}

function xRadioGroup($style=null){
    $obj = new \Jiny\UI\Html\XRadioGroup($style);
    return $obj;
}


if (!function_exists("xProgress")) {
    function xProgress($now=0, $max=100, $min=0)
    {
        return new \Jiny\UI\Html\XProgress($now, $max, $min);
    }
}

/**
 * Table
 */
function xTable($slot=null){
    return new \Jiny\UI\Html\XTable($slot);
}
function xTableHead($slot=null){
    return new \Jiny\UI\Html\XTableHead($slot);
}

function xTableBody($slot=null){
    return new \Jiny\UI\Html\XTableBody($slot);
}
function xTableCheckAll(){
    return new \Jiny\UI\Html\XTableCheckAll();
}
function xTableCheckRow($i){
    return new \Jiny\UI\Html\XTableCheckRow($i);
}



/**
 * component
 */

function xCollapse()
{
    return \Jiny\UI\Components\XCollapse::instance();
}

function xAccordion()
{
    return \Jiny\UI\Components\XAccordion::instance();
}

function xIcon($name) {
    return new \Jiny\UI\View\Components\Icon($name);
}

function xBadge($title, $attr=[]) {
    return (new \Jiny\UI\View\Components\Button\Badge($title, $attr));
}

function xBreadCrumb()
{
    return \Jiny\UI\Components\XBreadCrumb::instance();
}


function xList($attrs=[])
{
    return \Jiny\UI\Html\XList::instance($attrs);
}

function xListItem($value=null)
{
    return new \Jiny\UI\Html\XListItem($value);
}


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

//
function xTab()
{
    return \Jiny\UI\XTab::instance();
}

function xNav()
{
    return \Jiny\UI\Components\XNav::instance();
}


// Group 지정
function xGroup($items=[])
{
    return new \Jiny\UI\Html\XGroup($items);
}

// 링크생성
function xLink($item = null, $url = null)
{
    return new \Jiny\UI\Html\XLink($item, $url);
}

function xLinks($args=[])
{
    return new \Jiny\UI\Html\XLinks($args);
}



/**
 * 컴포넌트 : 버튼
 */
if (!function_exists("xButton")) {
    function xButton($item=null)
    {
        return new \Jiny\UI\Html\XButton($item);
    }
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