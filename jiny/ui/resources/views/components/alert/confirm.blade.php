<div {{ $attributes->merge(['class' => 'alert alert-dismissible']) }} role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-message">
        {{$slot}}

        <div class="btn-list">
            <button class="btn btn-light" type="button">Okay</button>
            <button class="btn btn-secondary" type="button">No, thanks</button>
        </div>
    </div>
</div>