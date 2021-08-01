{{-- <button {{ $attributes->merge(['class' => 'btn btn-pill']) }}>{{$slot}}</button> --}}
{!! BootButton()->addItem($slot)->setAttrs($attributes)->round() !!}