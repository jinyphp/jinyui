{{--
<li {{ $attributes->merge(['class' => 'breadcrumb-item']) }}>{{$slot}}</li>
--}}

@php
    // dd($attributes);
    if(isset($attributes['href'])) {
        $href = $attributes['href'];
    } else {
        $href = null;
    }
@endphp

{{ xBreadCrumb()->addLink($slot, $href ) }}