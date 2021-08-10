<thead>
    <tr>
        @if ($json)
            @foreach ( json_decode($json, true) as $item)
                <th
                @if (isset($item['class']))
                    class="{{ $item['class'] }}" 
                @endif

                @if (isset($item['style']))
                    style="{{ $item['style'] }}" 
                @endif

                >{{$item['title']}}</th>
            @endforeach
        @else
            {{-- 데이터없음--}}
            {{$slot}}
        @endif        
    </tr>
</thead>