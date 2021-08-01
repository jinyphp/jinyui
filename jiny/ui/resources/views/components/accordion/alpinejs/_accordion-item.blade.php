
<div class="accordion-item bg-white">
    <h2 class="p-4 border-b border-gray-100" 
        @click.prevent="show === {{$attributes['item']}} ? show = 0 : show = {{$attributes['item']}}" >
        @if (isset($title))
            {{$title}}
        @else
            Item #{{$attributes['item']}}
        @endif

    </h2>
    <div class="p-4" x-show="show === {{$attributes['item']}}">
        <div class="accordion-body">
            {{$slot}}
        </div>
    </div>
</div>  
