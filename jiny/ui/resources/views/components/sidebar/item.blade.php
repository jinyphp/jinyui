<li {{ $attributes->merge(['class' => 'sidebar-item']) }} >
    {{$slot}}
</li>


{{-- Bootstrap Code --}}
{{-- 
{!! CMenuItem()
    ->addItem( $slot )
    ->setLivewireAttrs($attributes)
    ->addClass("sidebar-item") !!}
--}}
