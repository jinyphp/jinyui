{{-- <button {{ $attributes->merge(['class' => 'btn btn-square']) }}>{{$slot}}</button> --}}
{!! BootButton()->addItem($slot)->setAttrs($attributes)->squre() !!}