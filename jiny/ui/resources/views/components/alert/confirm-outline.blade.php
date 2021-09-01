<div {{ $attributes->merge(['class' => 'alert alert-outline alert-dismissible']) }} role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-message">
        {{$slot}}

        <div class="btn-list">
            <button class="btn btn-success" type="button">Okay</button>
            <button class="btn btn-danger" type="button">No, thanks</button>
        </div>
    </div>
</div>