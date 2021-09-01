<x-flex-row-between>
    <div class="w-64 text-right" 
        style="padding: 5px 0;
            vertical-align: top;
            height: 24px;
            line-height: 24px;
            white-space: nowrap;">
        @if (isset($label))
            <label for="">{{$label}}</label>
        @endif  
    </div>

    <div class="flex-grow" 
        style="padding: 5px 0 5px 10px;
            vertical-align: middle;
            position: relative;">

        @if (isset($item))
            {{$item}}
        @endif 
    </div>

</x-flex-row-between>
