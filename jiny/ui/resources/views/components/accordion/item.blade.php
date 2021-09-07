<div {{ $attributes->merge(['class' => 'accordion-item']) }}>
    <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#{{xAccordion()->collapseId()}}" aria-expanded="true" >
            {{$title}}
        </button>
    </h2>
    
    <div id="{{xAccordion()->collapseId()}}" class="accordion-collapse collapse" 
            data-bs-parent="#{{xAccordion()->accordionId()}}"
    >
        <div class="accordion-body">
            {{$slot}}
        </div>
    </div>

</div>