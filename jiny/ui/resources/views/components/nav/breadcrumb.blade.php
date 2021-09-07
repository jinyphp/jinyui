<nav aria-label="breadcrumb">
    {{--
    <ol {{ $attributes->merge(['class' => 'breadcrumb']) }}>
        {{$slot}}
    </ol>
    --}}
    {!! xBreadCrumb()->show() !!}
</nav>