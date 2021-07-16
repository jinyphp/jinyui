<div {{ $attributes->merge(['class' => 'alert alert-outline alert-dismissible']) }} role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-icon">
        <x-icon.bell-outline></x-icon.bell-outline>
    </div>
    <div class="alert-message">
        {{$slot}}
    </div>
</div>