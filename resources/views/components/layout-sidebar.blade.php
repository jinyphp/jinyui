<nav {{ $attributes->merge(['class' => 'sidebar js-sidebar']) }} id="sidebar">
    <div class="sidebar-content js-simplebar">
        {{$slot}}
    </div>
</nav>
