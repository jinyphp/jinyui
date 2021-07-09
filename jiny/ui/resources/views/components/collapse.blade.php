<div x-data="{ open: false }">
    @if (isset($title))
        <div @click="open = ! open">{{$title}}</div>
        <div x-show="open">
            {{$slot}}
        </div>
    @else
        {{$slot}}
    @endif
</div>