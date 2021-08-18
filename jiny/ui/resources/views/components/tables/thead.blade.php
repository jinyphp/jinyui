@php
    if (empty($rows) && $json) {
        $rows = json_decode($json,true);
    }        
@endphp

{!! \Jiny\UI\Table::instance()->setDataHead( $rows, $attributes, $slot) !!}