{{-- <button {{ $attributes->merge(['class' => 'btn ']) }}>{{$slot}}</button> --}}
{!! BootButton()->addItem($slot)->setAttrs($attributes)->outline() !!}