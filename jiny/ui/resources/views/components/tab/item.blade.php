{{--
@push('tab-item')
<div {{ $attributes->merge(['class' => 'tab-pane fade']) }} role="tabpanel">
    {{$slot}}
</div>
@endpush
--}}

{{ BootTab()->pushContent($slot, $attributes) }}
