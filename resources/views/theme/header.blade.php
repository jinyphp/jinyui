<div class="flex flex-row justify-between">
    <div class="text-lg">
        @if (isset($title))
            {{$title}}
        @endif
    </div>
    <div>
        @if (isset($control))
            {{$control}}
        @endif
    </div>
</div>
