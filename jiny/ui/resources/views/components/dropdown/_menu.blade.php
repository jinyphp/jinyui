{{ $title}}

        <ul {{ $attributes->merge(['class' => 'dropdown-menu']) }}>
            
            {{--
            @if (isset($json))
                @foreach($json as $item)
                    <x-dropdown-item href="{{$item->href}}">{{$item->title}}</x-dropdown-item>
                @endforeach                        
            @endif
            --}}
            {{ $slot }}
        </ul>