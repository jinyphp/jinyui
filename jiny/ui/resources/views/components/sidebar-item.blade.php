{{--
<li {{ $attributes->merge(['class' => 'sidebar-item']) }} >
    
    <a class="sidebar-link" href="#">
        @if (isset($icon))
            {{$icon}}
        @endif
        <span class="align-middle">{{$slot}}</span>
    </a>
</li>
--}}


{!! CMenuItem()
    ->addItem( CLink($slot)->addClass("sidebar-link") )
    ->setLivewireAttrs($attributes)
    ->addClass("sidebar-item") !!} 

