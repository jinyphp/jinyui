<div {{ $attributes->merge(['class' => 'alert alert-dismissible']) }} role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-message">
        {{$slot}}
    </div>
</div>