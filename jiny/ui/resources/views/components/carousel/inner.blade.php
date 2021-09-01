{{BootCarousel()->setAttrs($attributes)}}

<div {{ BootCarousel()->attrs->merge(['class' => 'carousel slide']) }} data-bs-ride="carousel" id="{{BootCarousel()->uid()}}">

    @if (BootCarousel()->indicator)
        <div class="carousel-indicators">
            @foreach (BootCarousel()->stack as $key => $item)
                <button type="button" data-bs-target="#{{BootCarousel()->uid()}}" data-bs-slide-to="{{$key}}" aria-label="Slide {{$key}}" 
                    @if ($key == 0)
                        class="active" aria-current="true"
                    @endif                     
                ></button>                
            @endforeach
        </div>
    @endif

    <div class="carousel-inner">
        @foreach (BootCarousel()->stack as $item)
            <div {{ $item['attrs']->merge(['class' => 'carousel-item']) }}>
                {{$item['slot']}}
            </div>
        @endforeach
        {{$slot}}      
    </div>

    @if (BootCarousel()->controls)
        <button class="carousel-control-prev" type="button" data-bs-target="#{{BootCarousel()->uid()}}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#{{BootCarousel()->uid()}}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif

    
</div>

{{BootCarousel()->clear()}}
