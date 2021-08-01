{{--
<li class="nav-item">
    <a {{ $attributes->merge(['class' => 'nav-link']) }} data-bs-toggle="tab" role="tab">
        {{$slot}}
    </a>
</li>
--}}
{{ BNav()->setTab($slot, $attributes) }}


