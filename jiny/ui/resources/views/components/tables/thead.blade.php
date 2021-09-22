@php
    if (empty($rows) && $json) {
        $rows = json_decode($json,true);
    }        
@endphp

{!! 
    xTableHead($slot)
    ->setAttrs($attributes) 
!!}


{{--
{!! \Jiny\UI\Table::instance()->setDataHead( $rows, $attributes, $slot) !!}
--}}
