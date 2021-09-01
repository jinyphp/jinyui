<div {{ $attributes->merge(['class' => 'accordion-item']) }}>
    <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#{{uistack()->collapseId()}}" aria-expanded="true" >
            {{$title}}
        </button>
    </h2>
    
    <div id="{{uistack()->collapseId()}}" class="accordion-collapse collapse" 
            data-bs-parent="#{{uiStack()->accordionId()}}"
    >
        <div class="accordion-body">
            {{$slot}}
        </div>
    </div>

</div>