{{--
@push('tab-link')
<a {{ $attributes->merge(['class' => 'list-group-item list-group-item-action']) }} role="tab" aria-selected="false">
    {{$slot}}
</a>
@endpush
--}}

{{ BootTab()->pushHeader($slot, $attributes) }}
