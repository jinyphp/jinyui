@php
    if (empty($rows) && $json) {
        $rows = json_decode($json,true);
    }        
@endphp

{!! xTableBody($slot)->setAttrs($attributes) !!}

{{--
{!! \Jiny\UI\Table::instance()->setDataBody( $rows, $attributes, $slot) !!}
--}}